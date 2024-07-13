<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
    {
        $barang = Barang::with('pembelianItems.pembelian')->get();
        return view('barang.index', compact('barang'));
    }

    public function create()
    {
        return view('barang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'stok' => 'required|integer',
            'harga' => 'required|integer',
        ]);

        Barang::create($request->all());
        return redirect()->route('barang.index')
                         ->with('success', 'Barang created successfully.');
    }

    public function show(Barang $barang)
    {
        return view('barang.show', compact('barang'));
    }

    public function edit(Barang $barang)
    {
        return view('barang.edit', compact('barang'));
    }

    public function update(Request $request, Barang $barang)
    {
        $request->validate([
            'nama' => 'required',
            'stok' => 'required|integer',
            'harga' => 'required|integer',
        ]);

        $barang->update($request->all());
        return redirect()->route('barang.index')
                         ->with('success', 'Barang updated successfully.');
    }

    public function destroy(Barang $barang)
    {
        $barang->delete();
        return redirect()->route('barang.index')
                         ->with('success', 'Barang deleted successfully.');
    }
}
