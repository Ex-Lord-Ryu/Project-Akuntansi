<?php

namespace App\Http\Controllers;

use App\Models\Pembelian;
use App\Models\PembelianItem;
use App\Models\Barang;
use App\Models\Warna;
use Illuminate\Http\Request;

class PembelianItemController extends Controller
{
    public function index()
    {
        $pembelianItems = PembelianItem::with('barang', 'warna') ->orderBy('id', 'desc')->paginate(10);
        return view('pembelian_item.index', compact('pembelianItems'));
    }

    public function create()
    {
        $pembelians = Pembelian::all();
        $barangs = Barang::all();
        $warnas = Warna::all();
        return view('pembelian_item.create', compact('pembelians', 'barangs', 'warnas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_pembelian' => 'required|exists:pembelian,id',
            'id_barang' => 'required|exists:barang,id',
            'id_warna' => 'nullable|exists:warna,id',
            'no_rangka' => 'nullable|string|max:50',
            'no_mesin' => 'nullable|string|max:50',
            'harga' => 'required|numeric',
        ]);

        PembelianItem::create($request->all());

        return redirect()->route('pembelian_item.index')->with('success', 'Pembelian item created successfully.');
    }

    public function show($id)
    {
        $pembelianItem = PembelianItem::with('barang', 'warna')->findOrFail($id);
        return view('pembelian_item.show', compact('pembelianItem'));
    }

    public function edit($id)
    {
        $item = PembelianItem::findOrFail($id);
        return view('pembelian.items.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'id_warna' => 'required|exists:warna,id',
            'no_rangka' => 'required|string',
            'no_mesin' => 'required|string',
        ]);

        $item = PembelianItem::findOrFail($id);
        $item->update($validatedData);

        // Get the next pembelian item that needs to be edited
        $nextItem = PembelianItem::where('id_pembelian', $item->id_pembelian)->whereNull('id_warna')->orWhereNull('no_rangka')->orWhereNull('no_mesin')->first();

        if ($nextItem) {
            return redirect()->route('pembelian.items.edit', $nextItem->id)->with('success', 'Pembelian item updated successfully. Please update the next pembelian item.');
        }

        return redirect()->route('pembelian.index')->with('success', 'Pembelian item updated successfully.');
    }

    public function destroy($id)
    {
        $pembelianItem = PembelianItem::findOrFail($id);
        $pembelianItem->delete();

        return redirect()->route('pembelian_item.index')->with('success', 'Pembelian item deleted successfully.');
    }
}
