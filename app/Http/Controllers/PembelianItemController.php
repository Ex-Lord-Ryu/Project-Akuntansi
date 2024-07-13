<?php

namespace App\Http\Controllers;

use App\Models\PembelianItem;
use App\Models\Pembelian;
use App\Models\Barang;
use Illuminate\Http\Request;

class PembelianItemController extends Controller
{
    public function index()
    {
        $pembelian_items = PembelianItem::with('pembelian', 'barang')->paginate(10);
        return view('pembelian_item.index', compact('pembelian_items'));
    }

    public function create()
    {
        $pembelians = Pembelian::all();
        $barangs = Barang::all();
        return view('pembelian_item.create', compact('pembelians', 'barangs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_pembelian' => 'required|exists:pembelian,id',
            'id_barang' => 'required|exists:barangs,id',
            'qty' => 'required|integer',
            'harga' => 'required|numeric',
            'ppn' => 'required|integer',
        ]);

        PembelianItem::create($request->all());
        return redirect()->route('pembelian_item.index')
            ->with('success', 'Pembelian Item created successfully.');
    }

    public function show(PembelianItem $pembelian_item)
    {
        return view('pembelian_item.show', compact('pembelian_item'));
    }

    public function edit(PembelianItem $pembelian_item)
    {
        $pembelians = Pembelian::all();
        $barangs = Barang::all();
        return view('pembelian_item.edit', compact('pembelian_item', 'pembelians', 'barangs'));
    }

    public function update(Request $request, PembelianItem $pembelian_item)
    {
        $request->validate([
            'id_pembelian' => 'required|exists:pembelian,id',
            'id_barang' => 'required|exists:barang,id',
            'qty' => 'required|integer',
            'harga' => 'required|numeric',
            'ppn' => 'required|integer',
        ]);

        $pembelian_item->update($request->all());

        return redirect()->route('pembelian_item.index')->with('success', 'Pembelian Item updated successfully.');
    }


    public function destroy(PembelianItem $pembelian_item)
    {
        $pembelian_item->delete();
        return redirect()->route('pembelian_item.index')
            ->with('success', 'Pembelian Item deleted successfully.');
    }
}
