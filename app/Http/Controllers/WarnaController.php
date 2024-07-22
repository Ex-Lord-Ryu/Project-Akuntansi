<?php

namespace App\Http\Controllers;

use App\Models\Warna;
use Illuminate\Http\Request;

class WarnaController extends Controller
{
    public function index()
    {
        $warna = Warna::all();
        return view('warna.index', compact('warna'));
    }

    public function create()
    {
        return view('warna.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'id' => 'required|string|unique:warna,id',
            'warna' => 'required|string|max:255',
        ]);

        Warna::create($request->all());

        return redirect()->route('warna.index')->with('success', 'Warna berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $warna = Warna::findOrFail($id);
        return view('warna.edit', compact('warna'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'warna' => 'required|string|max:255',
        ]);

        $warna = Warna::findOrFail($id);
        $warna->update($request->all());

        return redirect()->route('warna.index')->with('success', 'Warna berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $warna = Warna::findOrFail($id);
        $warna->delete();

        return redirect()->route('warna.index')->with('success', 'Warna berhasil dihapus.');
    }
}
