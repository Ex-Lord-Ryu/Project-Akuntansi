<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index()
    {
        $pelanggan = Pelanggan::all();
        return view('pelanggan.index', compact('pelanggan'));
    }

    public function create()
    {
        return view('pelanggan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'tgl_lahir' => 'required|date',
            'no_hp' => 'nullable|string',
            'email' => 'nullable|email',
            'alamat' => 'required|string',
            'wilayah' => 'required|string',
            'provinsi' => 'required|string',
        ]);

        Pelanggan::create($request->all());
        return redirect()->route('pelanggan.index')
                         ->with('success', 'Pelanggan created successfully.');
    }

    public function show(Pelanggan $pelanggan)
    {
        return view('pelanggan.show', compact('pelanggan'));
    }

    public function edit(Pelanggan $pelanggan)
    {
        return view('pelanggan.edit', compact('pelanggan'));
    }

    public function update(Request $request, Pelanggan $pelanggan)
    {
        $request->validate([
            'nama' => 'required',
            'tgl_lahir' => 'required|date',
            'no_hp' => 'nullable|string',
            'email' => 'nullable|email',
            'alamat' => 'required|string',
            'wilayah' => 'required|string',
            'provinsi' => 'required|string',
        ]);

        $pelanggan->update($request->all());
        return redirect()->route('pelanggan.index')
                         ->with('success', 'Pelanggan updated successfully.');
    }

    public function destroy(Pelanggan $pelanggan)
    {
        $pelanggan->delete();
        return redirect()->route('pelanggan.index')
                         ->with('success', 'Pelanggan deleted successfully.');
    }
}
