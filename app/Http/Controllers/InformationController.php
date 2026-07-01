<?php
namespace App\Http\Controllers;
use App\Models\Information;
use Illuminate\View\View;

class InformationController extends Controller {
    public function index(): View {
        $informations = Information::where('is_published', true)->latest()->get();
        return view('information.index', ['informations' => $informations]);
    }
    public function show(Information $information): View {
        return view('information.show', ['info' => $information]);
    }
}