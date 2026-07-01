<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tournament;
use App\Models\TournamentRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AdminTournamentController extends Controller
{
    public function index()
    {
        $tournaments = Tournament::latest()->paginate(10);
        return view('admin.tournaments.index', compact('tournaments'));
    }

    public function create()
    {
        return view('admin.tournaments.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:tournaments,name',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5024',
            'start_date' => 'required|date',
            'registration_open_date' => 'required|date',
            'registration_deadline' => 'required|date|after:registration_open_date',
            'entry_fee' => 'required|numeric|min:0',
        ]);

        $validated['slug'] = Str::slug($request->name);
        
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('tournaments', 'public');
        }

        Tournament::create($validated);
        return redirect()->route('admin.tournaments.index')->with('success', 'Turnamen baru berhasil ditambahkan.');
    }

    public function edit(Tournament $tournament)
    {
        return view('admin.tournaments.edit', compact('tournament'));
    }

    public function update(Request $request, Tournament $tournament)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:tournaments,name,' . $tournament->id,
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5024',
            'start_date' => 'required|date',
            'registration_open_date' => 'required|date',
            'registration_deadline' => 'required|date|after:registration_open_date',
            'entry_fee' => 'required|numeric|min:0',
        ]);

        if ($request->name !== $tournament->name) {
            $validated['slug'] = Str::slug($request->name);
        }

        if ($request->hasFile('image')) {
            if ($tournament->image) {
                Storage::disk('public')->delete($tournament->image);
            }
            $validated['image'] = $request->file('image')->store('tournaments', 'public');
        }

        $tournament->update($validated);
        return redirect()->route('admin.tournaments.index')->with('success', 'Data turnamen berhasil diperbarui.');
    }

    public function destroy(Tournament $tournament)
    {
        if ($tournament->image) {
            Storage::disk('public')->delete($tournament->image);
        }
        $tournament->delete();
        return redirect()->route('admin.tournaments.index')->with('success', 'Turnamen berhasil dihapus.');
    }
    
    public function showRegistrations(Tournament $tournament)
    {
        $registrations = TournamentRegistration::where('tournament_id', $tournament->id)
                            ->with('user')
                            ->paginate(20);

        return view('admin.tournaments.registrations', compact('tournament', 'registrations'));
    }


    public function confirmRegistration(TournamentRegistration $registration)
    {
        $registration->update(['status' => 'confirmed']);
        return back()->with('success', 'Pendaftaran berhasil dikonfirmasi.');
    }

    public function cancelRegistration(TournamentRegistration $registration)
    {
        $registration->update(['status' => 'cancelled']);
        return back()->with('success', 'Pendaftaran berhasil dibatalkan/ditolak.');
    }
}