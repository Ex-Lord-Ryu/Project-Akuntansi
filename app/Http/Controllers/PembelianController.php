<?php

namespace App\Http\Controllers;

use App\Models\Warna;
use App\Models\Barang;
use App\Models\Status;
use App\Models\Vendor;
use App\Models\Pengirim;
use App\Models\Pembelian;
use Illuminate\Http\Request;
use App\Models\PembelianItem;
use App\Models\Stok;

class PembelianController extends Controller
{
    public function index()
    {
        $pembelian = Pembelian::with('vendor', 'pengirim', 'status')
                              ->orderBy('id', 'desc')
                              ->paginate(10);
        return view('pembelian.index', compact('pembelian'));
    }

    public function create()
    {
        $vendors = Vendor::all();
        $statuses = Status::all();
        $pengirims = Pengirim::all();
        $barangs = Barang::all();
        $warnas = Warna::all();

        $pembelian = new Pembelian();
        $pembelian->items = collect();

        return view('pembelian.create', compact('vendors', 'statuses', 'pengirims', 'barangs', 'warnas', 'pembelian'));
    }

    public function storeWithItems(Request $request)
    {
        $validatedData = $request->validate([
            'id_vendor' => 'required|exists:vendors,id',
            'tgl_pembelian' => 'required|date',
            'id_status' => 'required|exists:statuses,id',
            'id_pengirim' => 'nullable|exists:pengirims,id',
            'tgl_pengiriman' => 'nullable|date',
            'items.*.id_barang' => 'required|exists:barang,id',
            'items.*.id_warna' => 'nullable|exists:warna,id',
            'items.*.harga' => 'required|integer|min:0',
        ]);

        $pembelian = Pembelian::create([
            'id_vendor' => $validatedData['id_vendor'],
            'tgl_pembelian' => $validatedData['tgl_pembelian'],
            'id_status' => $validatedData['id_status'],
            'id_pengirim' => $validatedData['id_pengirim'],
            'tgl_pengiriman' => $validatedData['tgl_pengiriman'],
        ]);

        foreach ($validatedData['items'] as $item) {
            PembelianItem::create([
                'id_pembelian' => $pembelian->id,
                'id_barang' => $item['id_barang'],
                'id_warna' => $item['id_warna'] ?? null,
                'harga' => $item['harga'],
            ]);
        }

        return redirect()->route('pembelian.index')->with('success', 'Pembelian berhasil ditambahkan beserta item-itemnya.');
    }

    public function show($id)
    {
        $pembelian = Pembelian::with('vendor', 'status', 'pengirim', 'items.barang')->findOrFail($id);
        return view('pembelian.show', compact('pembelian'));
    }

    public function edit($id)
    {
        $pembelian = Pembelian::with('items')->findOrFail($id);
        $vendors = Vendor::all();
        $pengirims = Pengirim::all();
        $statuses = Status::all();
        $barangs = Barang::all();
        $warnas = Warna::all();

        return view('pembelian.edit', compact('pembelian', 'vendors', 'pengirims', 'statuses', 'barangs', 'warnas'));
    }

    public function update(Request $request, Pembelian $pembelian)
    {
        $validatedData = $request->validate([
            'id_vendor' => 'required|exists:vendors,id',
            'tgl_pembelian' => 'required|date',
            'id_status' => 'required|exists:statuses,id',
            'id_pengirim' => 'nullable|exists:pengirims,id',
            'tgl_pengiriman' => 'nullable|date',
            'items' => 'required|array',
            'items.*.id' => 'nullable|exists:pembelian_item,id',
            'items.*.id_barang' => 'required|exists:barang,id',
            'items.*.id_warna' => 'nullable|exists:warna,id',
            'items.*.harga' => 'required|integer|min:0',
        ]);

        $pembelian->update([
            'id_vendor' => $validatedData['id_vendor'],
            'tgl_pembelian' => $validatedData['tgl_pembelian'],
            'id_status' => $validatedData['id_status'],
            'id_pengirim' => $validatedData['id_pengirim'],
            'tgl_pengiriman' => $validatedData['tgl_pengiriman'],
        ]);

        foreach ($validatedData['items'] as $itemData) {
            if (isset($itemData['id'])) {
                $item = PembelianItem::find($itemData['id']);
                $item->update([
                    'id_barang' => $itemData['id_barang'],
                    'id_warna' => $itemData['id_warna'] ?? null,
                    'harga' => $itemData['harga'],
                ]);
            } else {
                PembelianItem::create([
                    'id_pembelian' => $pembelian->id,
                    'id_barang' => $itemData['id_barang'],
                    'id_warna' => $itemData['id_warna'] ?? null,
                    'harga' => $itemData['harga'],
                ]);
            }
        }

        if ($pembelian->id_status == 4) {
            $this->updateStokIfStatusDelivered($pembelian);
        }

        return redirect()->route('pembelian.index')->with('success', 'Pembelian updated successfully.');
    }

    public function updateStatus(Pembelian $pembelian, $status)
    {
        if ($status > $pembelian->id_status) {
            if ($status == 4 && empty($pembelian->tgl_pengiriman)) {
                return redirect()->route('pembelian.index')
                    ->with('popup_error', 'Tanggal Pengiriman harus diisi untuk status dikirim.');
            }

            $pembelian->update(['id_status' => $status]);

            if ($status == 4) {
                $this->updateStokIfStatusDelivered($pembelian);
            }
        }

        return redirect()->route('pembelian.index')->with('success', 'Status updated successfully.');
    }

    private function updateStokIfStatusDelivered(Pembelian $pembelian)
    {
        foreach ($pembelian->items as $item) {
            Stok::updateOrCreate(
                [
                    'id_pembelian' => $pembelian->id,
                    'id_pembelian_item' => $item->id,
                    'id_barang' => $item->id_barang,
                    'id_warna' => $item->id_warna,
                ],
                [
                    'harga' => $item->harga,
                    'tgl_penerimaan' => $pembelian->tgl_pengiriman,
                ]
            );
        }
    }

    public function destroy(Pembelian $pembelian)
    {
        $pembelian->delete();
        return redirect()->route('pembelian.index')->with('success', 'Pembelian deleted successfully.');
    }
}
