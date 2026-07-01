<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\BilliardTable;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminBookingController extends Controller
{
    /**
     * Menampilkan SEMUA booking (Riwayat).
     */
    public function index()
    {
        $bookings = Booking::with(['user', 'billiardTable'])->latest()->paginate(15);
        return view('admin.bookings.index', compact('bookings'));
    }

    /**
     * Menampilkan booking yang butuh tindakan (status 'pending').
     */
    public function manage()
    {
        $pendingBookings = Booking::with(['user', 'billiardTable'])
            ->where('status', 'pending')
            ->latest()
            ->paginate(15);
            
        return view('admin.bookings.manage', compact('pendingBookings'));
    }

    /**
     * Mengkonfirmasi booking.
     */
    public function confirm(Booking $booking)
    {
        $booking->update(['status' => 'confirmed']);
        return redirect()->route('admin.bookings.manage')->with('success', 'Booking berhasil dikonfirmasi.');
    }

    /**
     * Membatalkan booking.
     */
    public function cancel(Booking $booking)
    {
        $booking->update(['status' => 'cancelled']);
        return redirect()->route('admin.bookings.manage')->with('success', 'Booking berhasil dibatalkan.');
    }

    /**
     * Menampilkan form untuk mengedit booking.
     */
    public function edit(Booking $booking)
    {
        $users = User::where('role', 'user')->get();
        $tables = BilliardTable::all();
        return view('admin.bookings.edit', compact('booking', 'users', 'tables'));
    }

    /**
     * Memproses update booking.
     */
    public function update(Request $request, Booking $booking)
    {
        $request->validate([
            'billiard_table_id' => 'required|exists:billiard_tables,id',
            'start_time' => 'required|date',
            'duration' => 'required|integer|min:1',
            'status' => 'required|in:pending,confirmed,cancelled,completed',
        ]);

        $table = BilliardTable::find($request->billiard_table_id);
        $startTime = Carbon::parse($request->start_time);
        $durationInMinutes = $request->duration * 60;
        $endTime = $startTime->copy()->addMinutes($durationInMinutes);
        $totalPrice = ($table->price_per_hour / 60) * $durationInMinutes;

        $booking->update([
            'billiard_table_id' => $request->billiard_table_id,
            'start_time' => $startTime,
            'end_time' => $endTime,
            'duration_in_minutes' => $durationInMinutes,
            'total_price' => $totalPrice,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.bookings.index')->with('success', 'Data booking berhasil diperbarui.');
    }

    /**
     * Menghapus booking.
     */
    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('admin.bookings.index')->with('success', 'Data booking berhasil dihapus.');
    }
}