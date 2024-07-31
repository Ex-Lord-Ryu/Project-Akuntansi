<?php

namespace App\Http\Controllers;

use App\Models\PenjualanItem;
use App\Models\Penjualan;
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

    public function show($id)
    {
        $penjualanItem = PenjualanItem::findOrFail($id);
        return redirect()->route('penjualan.show', ['penjualan' => $penjualanItem->id_penjualan]);
    }

    public function edit($id)
    {
        $penjualanItem = PenjualanItem::findOrFail($id);
        return redirect()->route('penjualan.edit', ['penjualan' => $penjualanItem->id_penjualan]);
    }

    public function update(Request $request, $id)
    {
        $penjualanItem = PenjualanItem::findOrFail($id);

        $request->validate([
            'id_penjualan' => 'required|exists:penjualan,id',
            'id_barang' => 'required|exists:barang,id',
            'id_stok' => 'required|exists:stok,id',
            'id_warna' => 'nullable|exists:warna,id',
            'no_rangka' => 'nullable|string|max:50',
            'no_mesin' => 'nullable|string|max:50',
            'harga' => 'required|integer',
        ]);

        $penjualanItem->update($request->all());
        return redirect()->route('penjualan_item.index')->with('success', 'Penjualan Item berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $penjualanItem = PenjualanItem::findOrFail($id);
        $penjualanItem->delete();
        return redirect()->route('penjualan_item.index')->with('success', 'Penjualan Item berhasil dihapus.');
    }
}
