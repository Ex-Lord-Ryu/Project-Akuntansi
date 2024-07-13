<?php

namespace App\Http\Controllers;

use App\Models\PenjualanItem;
use App\Models\Penjualan;
use App\Models\Barang;
use Illuminate\Http\Request;

class PenjualanItemController extends Controller
{
    public function index()
    {
        $penjualan_items = PenjualanItem::with('penjualan', 'barang')->paginate(10);
        return view('penjualan_item.index', compact('penjualan_items'));
    }

    public function create()
    {
        $penjualans = Penjualan::all();
        $barangs = Barang::all();
        return view('penjualan_item.create', compact('penjualans', 'barangs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'penjualan_id' => 'required|exists:penjualan,id',
            'barang_id' => 'required|exists:barang,id',
            'qty' => 'required|integer',
            'harga' => 'required|integer',
            'ppn' => 'required|integer',
        ]);

        PenjualanItem::create($request->all());
        return redirect()->route('penjualan_item.index')
                         ->with('success', 'Penjualan Item created successfully.');
    }

    public function show(PenjualanItem $penjualan_item)
    {
        return view('penjualan_item.show', compact('penjualan_item'));
    }

    public function edit(PenjualanItem $penjualan_item)
    {
        $penjualans = Penjualan::all();
        $barangs = Barang::all();
        return view('penjualan_item.edit', compact('penjualan_item', 'penjualans', 'barangs'));
    }

    public function update(Request $request, PenjualanItem $penjualan_item)
    {
        $request->validate([
            'penjualan_id' => 'required|exists:penjualan,id',
            'barang_id' => 'required|exists:barang,id',
            'qty' => 'required|integer',
            'harga' => 'required|integer',
            'ppn' => 'required|integer',
        ]);

        $penjualan_item->update($request->all());
        return redirect()->route('penjualan_item.index')
                         ->with('success', 'Penjualan Item updated successfully.');
    }

    public function destroy(PenjualanItem $penjualan_item)
    {
        $penjualan_item->delete();
        return redirect()->route('penjualan_item.index')
                         ->with('success', 'Penjualan Item deleted successfully.');
    }
}
