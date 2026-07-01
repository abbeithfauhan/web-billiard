<?php
namespace App\Http\Controllers;

use App\Models\BilliardTable;
use App\Models\Booking;
use App\Services\ActivityService;
use Illuminate\Http\Request;
use Carbon\Carbon;


class BookingController extends Controller
{
    public function index()
    {
        // Alihkan ke halaman utama booking
        return redirect()->route('booking.create');
    }

    public function create()
    {
        $tables = BilliardTable::all();
        
        foreach ($tables as $table) {
            // Cek apakah ada booking yang sedang berlangsung SAAT INI untuk meja ini
            $isActiveBooking = Booking::where('billiard_table_id', $table->id)
                ->where('status', 'confirmed') // Hanya yang sudah dikonfirmasi
                ->where('start_time', '<=', now()) // Waktu mulai sudah lewat
                ->where('end_time', '>', now())    // Waktu selesai belum tiba
                ->exists();
                
            $table->status = $isActiveBooking ? 'dipakai' : 'kosong';
        }
        
        return view('booking.create', ['tables' => $tables]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'billiard_table_id' => 'required|exists:billiard_tables,id',
            // Aturan validasi yang sangat penting: tanggal harus valid dan tidak boleh di masa lalu.
            'start_time' => 'required|date|after_or_equal:now',
            'duration' => 'required|integer|min:1|max:8', // Batasi durasi booking (misal: maks 8 jam)
        ]);

        $table = BilliardTable::findOrFail($validated['billiard_table_id']);
        $startTime = Carbon::parse($validated['start_time']);
        $durationInMinutes = $validated['duration'] * 60;
        $endTime = $startTime->copy()->addMinutes($durationInMinutes);

        // Pengecekan Ketersediaan yang lebih akurat
        $isOccupied = Booking::where('billiard_table_id', $table->id)
            ->where('status', 'confirmed')
            ->where(function ($query) use ($startTime, $endTime) {
                // Logika untuk cek tumpang tindih waktu
                $query->where('start_time', '<', $endTime)
                      ->where('end_time', '>', $startTime);
            })->exists();
        
        if ($isOccupied) {
            // Kembalikan pesan error yang jelas jika meja sudah dibooking pada rentang waktu itu
            return back()->withErrors(['start_time' => 'Meja sudah dibooking pada rentang waktu tersebut. Silakan pilih waktu lain.'])->withInput();
        }

        $totalPrice = ($table->price_per_hour / 60) * $durationInMinutes;

        $booking = Booking::create([
            'user_id' => $request->user()->id,
            'billiard_table_id' => $validated['billiard_table_id'],
            'start_time' => $startTime,
            'end_time' => $endTime,
            'duration_in_minutes' => $durationInMinutes,
            'total_price' => $totalPrice,
            'status' => 'pending' // Status awal adalah pending, menunggu konfirmasi admin
        ]);

        // Log activity untuk booking
        $durationHours = $validated['duration'];
        ActivityService::logBooking($request->user(), [
            'table_name' => $table->name,
            'hours' => $durationHours,
            'price' => $totalPrice,
        ]);

        return redirect()->route('booking.history')->with('success', 'Permintaan booking Anda telah dikirim dan sedang menunggu konfirmasi dari admin.');
    }


    public function history(Request $request) // Tambahkan Request di sini
    {
        $bookings = Booking::where('user_id', $request->user()->id) // <-- GANTI DI SINI
                        ->with('billiardTable')
                        ->latest()
                        ->paginate(10);
        return view('booking.history', compact('bookings'));
    }
}
