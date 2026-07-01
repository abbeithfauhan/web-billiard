<?php

namespace App\Http\Controllers;

use App\Models\Tournament;
use App\Models\TournamentRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\View\View;

class TournamentController extends Controller
{
    /**
     * Menampilkan halaman daftar semua turnamen.
     */
    public function index(): View
    {
        // Ambil semua turnamen, dan juga relasi pendaftarannya untuk pengecekan
        $tournaments = Tournament::with('registrations')->latest()->paginate(9);
        return view('tournaments.index', compact('tournaments'));
    }

    /**
     * Menampilkan halaman riwayat pendaftaran turnamen milik pengguna.
     */
    public function myTournaments(): View
    {
        $my_registrations = TournamentRegistration::where('user_id', Auth::id())
            ->with('tournament') // Ambil data turnamen terkait
            ->latest('id')
            ->get();
        
        return view('tournaments.my', compact('my_registrations'));
    }

    /**
     * Memproses pendaftaran user ke sebuah turnamen.
     */
    public function register(Request $request, Tournament $tournament)
    {
        // Validasi 1: Pendaftaran harus dalam rentang waktu yang ditentukan.
        if (Carbon::now()->isBefore($tournament->registration_open_date) || Carbon::now()->isAfter($tournament->registration_deadline)) {
            return back()->with('error', 'Pendaftaran untuk turnamen ini tidak sedang dibuka.');
        }

        // Validasi 2: Satu user hanya bisa daftar sekali per turnamen.
        $isRegistered = TournamentRegistration::where('user_id', Auth::id())
                            ->where('tournament_id', $tournament->id)
                            ->exists();

        if ($isRegistered) {
            return back()->with('error', 'Anda sudah terdaftar di turnamen ini.');
        }

        // Jika semua validasi lolos, buat pendaftaran baru.
        TournamentRegistration::create([
            'user_id' => Auth::id(),
            'tournament_id' => $tournament->id,
            'status' => 'pending', // Status awal selalu 'pending'
        ]);

        return redirect()->route('tournaments.my')->with('success', 'Anda berhasil mendaftar turnamen! Status pendaftaran Anda pending menunggu konfirmasi pembayaran dari admin.');
    }
}