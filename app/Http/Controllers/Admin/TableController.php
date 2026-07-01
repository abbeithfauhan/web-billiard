<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BilliardTable;
use Illuminate\Http\Request;

class TableController extends Controller
{
    public function index()
    {
        $tables = BilliardTable::latest()->paginate(10);
        return view('admin.tables.index', compact('tables'));
    }

    public function create()
    {
        return view('admin.tables.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string',
            'price_per_hour' => 'required|numeric|min:0',
            'is_active' => 'required|boolean',
        ]);
        BilliardTable::create($validated);
        return redirect()->route('admin.tables.index')->with('success', 'Meja baru berhasil ditambahkan.');
    }

    public function edit(BilliardTable $table)
    {
        return view('admin.tables.edit', compact('table'));
    }

    public function update(Request $request, BilliardTable $table)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string',
            'price_per_hour' => 'required|numeric|min:0',
            'is_active' => 'required|boolean',
        ]);
        $table->update($validated);
        return redirect()->route('admin.tables.index')->with('success', 'Data meja berhasil diperbarui.');
    }

    public function destroy(BilliardTable $table)
    {
        $table->delete();
        return redirect()->route('admin.tables.index')->with('success', 'Data meja berhasil dihapus.');
    }
}