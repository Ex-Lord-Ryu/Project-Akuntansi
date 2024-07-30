<?php

namespace App\Http\Controllers;

use App\Models\PenjualanItem;
use App\Models\Penjualan;
use App\Models\Barang;
use App\Models\Stok;
use Illuminate\Http\Request;

class PenjualanItemController extends Controller
{
    public function index(Request $request)
    {
        $query = PenjualanItem::with('barang', 'stok', 'warna', 'penjualan')->orderBy('id', 'desc');

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->whereHas('barang', function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%");
            })
                ->orWhereHas('stok', function ($q) use ($search) {
                    $q->where('no_rangka', 'like', "%{$search}%");
                })
                ->orWhere('no_rangka', 'like', "%{$search}%")
                ->orWhere('no_mesin', 'like', "%{$search}%")
                ->orWhere('id_penjualan', 'like', "%{$search}%");
        }

        $penjualanItems = $query->paginate(10);
        return view('penjualan_item.index', compact('penjualanItems'));
    }

    public function create()
    {
        $penjualans = Penjualan::all();
        $barangs = Barang::all();
        $stoks = Stok::all();
        return view('penjualan_item.create', compact('penjualans', 'barangs', 'stoks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_penjualan' => 'required|exists:penjualan,id',
            'id_barang' => 'required|exists:barang,id',
            'id_stok' => 'required|exists:stok,id',
            'id_warna' => 'nullable|exists:warna,id',
            'no_rangka' => 'nullable|string|max:50',
            'no_mesin' => 'nullable|string|max:50',
            'harga' => 'required|integer',
        ]);

        PenjualanItem::create([
            'id_penjualan' => $request->id_penjualan,
            'id_barang' => $request->id_barang,
            'id_stok' => $request->id_stok,
            'id_warna' => $request->id_warna,
            'no_rangka' => $request->no_rangka,
            'no_mesin' => $request->no_mesin,
            'harga' => $request->harga,
        ]);

        return redirect()->route('penjualan_item.index')->with('success', 'Penjualan Item berhasil ditambahkan.');
    }

    public function show(Penjualan $penjualan)
    {
        $penjualan->load('penjualanItems'); // Memuat relasi penjualanItems
        return view('penjualan.show', compact('penjualan'));
    }



    public function edit(PenjualanItem $penjualan_item)
    {
        $penjualans = Penjualan::all();
        $barangs = Barang::all();
        $stoks = Stok::all();
        return view('penjualan_item.edit', compact('penjualan_item', 'penjualans', 'barangs', 'stoks'));
    }

    public function update(Request $request, PenjualanItem $penjualan_item)
    {
        $request->validate([
            'id_penjualan' => 'required|exists:penjualan,id',
            'id_barang' => 'required|exists:barang,id',
            'id_stok' => 'required|exists:stok,id',
            'id_warna' => 'nullable|exists:warna,id',
            'no_rangka' => 'nullable|string|max:50',
            'no_mesin' => 'nullable|string|max:50',
            'harga' => 'required|integer',
        ]);

        $penjualan_item->update([
            'id_penjualan' => $request->id_penjualan,
            'id_barang' => $request->id_barang,
            'id_stok' => $request->id_stok,
            'id_warna' => $request->id_warna,
            'no_rangka' => $request->no_rangka,
            'no_mesin' => $request->no_mesin,
            'harga' => $request->harga,
        ]);

        return redirect()->route('penjualan_item.index')->with('success', 'Penjualan Item berhasil diperbarui.');
    }

    public function destroy(PenjualanItem $penjualan_item)
    {
        $penjualan_item->delete();
        return redirect()->route('penjualan_item.index')->with('success', 'Penjualan Item berhasil dihapus.');
    }
}
