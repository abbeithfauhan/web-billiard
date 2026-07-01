<?php

namespace App\Http\Controllers;

use App\Models\Information;
use App\Models\Tournament;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil 3 informasi terbaru
        $latest_informations = Information::where('is_published', true)->latest()->take(3)->get();
        
        // Ambil 3 turnamen terbaru
        $latest_tournaments = Tournament::latest()->take(3)->get();

        return view('welcome', [
            'informations' => $latest_informations,
            'tournaments' => $latest_tournaments,
        ]);
    }
}