<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Information;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AdminInformationController extends Controller
{
    public function index()
    {
        $informations = Information::latest()->paginate(10);
        return view('admin.information.index', compact('informations'));
    }

    public function create()
    {
        return view('admin.information.create');
    }

    public function store(Request $request)
    {
        // 1. Validasi Input
        $validated = $request->validate([
            'title' => 'required|string|max:255|unique:information,title',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5024',
        ]);

        // 2. Tambahkan slug secara manual
        $validated['slug'] = Str::slug($validated['title']);

        // 3. Proses upload gambar jika ada
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('information', 'public');
        }

        // 4. Simpan ke database
        Information::create($validated);

        // 5. Redirect dengan pesan sukses
        return redirect()->route('admin.information.index')->with('success', 'Informasi baru berhasil ditambahkan.');
    }

    public function edit(Information $information)
    {
        return view('admin.information.edit', compact('information'));
    }

    public function update(Request $request, Information $information)
    {
        // Validasi dengan pengecualian untuk judul yang sama
        $validated = $request->validate([
            'title' => 'required|string|max:255|unique:information,title,' . $information->id,
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->title !== $information->title) {
            $validated['slug'] = Str::slug($request->title);
        }

        if ($request->hasFile('image')) {
            if ($information->image) {
                Storage::disk('public')->delete($information->image);
            }
            $validated['image'] = $request->file('image')->store('information', 'public');
        }

        $information->update($validated);
        return redirect()->route('admin.information.index')->with('success', 'Informasi berhasil diperbarui.');
    }

    public function destroy(Information $information)
    {
        if ($information->image) {
            Storage::disk('public')->delete($information->image);
        }
        $information->delete();
        return redirect()->route('admin.information.index')->with('success', 'Informasi berhasil dihapus.');
    }
}