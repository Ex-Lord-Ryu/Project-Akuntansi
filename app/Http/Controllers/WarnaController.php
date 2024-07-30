<?php

namespace App\Http\Controllers;

use App\Models\Warna;
use Illuminate\Http\Request;

class WarnaController extends Controller
{
    public function index(Request $request)
    {
        $query = Warna::query();

        if ($request->has('search')) {
            $query->where('warna', 'like', '%' . $request->search . '%')
            ->where('id', 'like', '%' . $request->search . '%');
        }

        $warna = $query->paginate(10);
        return view('warna.index', compact('warna'));
    }

    public function create()
    {
        return view('warna.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'id' => 'required|string|min:3|unique:warna,id',
            'warna' => 'required|string|min:3|unique:warna,warna',
        ], [
            'id.required' => 'ID wajib diisi.',
            'id.string' => 'ID harus berupa string.',
            'id.min' => 'ID harus memiliki panjang minimal 3 karakter.',
            'id.unique' => 'ID sudah ada.',
            'warna.required' => 'Warna wajib diisi.',
            'warna.string' => 'Warna harus berupa string.',
            'warna.min' => 'Warna harus memiliki panjang minimal 3 karakter.',
            'warna.unique' => 'Warna sudah ada.',
        ]);

        Warna::create($request->all());

        return redirect()->route('warna.index')->with('success', 'Warna created successfully.');
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
