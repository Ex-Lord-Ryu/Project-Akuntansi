<?php

namespace App\Http\Controllers;

use App\Models\Pembelian;
use App\Models\PembelianItem;
use App\Models\Barang;
use App\Models\Vendor;
use App\Models\Pengirim;
use App\Models\Status;
use Illuminate\Http\Request;

class PembelianController extends Controller
{
    public function index()
    {
        $pembelian = Pembelian::with('vendor', 'pengirim', 'status')->paginate(10);
        return view('pembelian.index', compact('pembelian'));
    }

    public function create()
    {
        $vendors = Vendor::all();
        $pengirims = Pengirim::all();
        $statuses = Status::all();
        $barangs = Barang::all();
        return view('pembelian.create', compact('vendors', 'pengirims', 'statuses', 'barangs'));
    }

    public function storeWithItems(Request $request)
    {
        $request->validate([
            'id_vendor' => 'required|exists:vendors,id',
            'tgl_pembelian' => 'required|date',
            'id_status' => 'required|exists:statuses,id',
            'id_pengirim' => 'nullable|exists:pengirims,id',
            'tgl_pengiriman' => 'nullable|date',
            'items' => 'required|array',
            'items.*.id_barang' => 'required|exists:barang,id',
            'items.*.qty' => 'required|integer',
            'items.*.harga' => 'required|numeric',
            'items.*.ppn' => 'required|integer'
        ]);

        $pembelian = Pembelian::create([
            'id_vendor' => $request->id_vendor,
            'tgl_pembelian' => $request->tgl_pembelian,
            'id_status' => $request->id_status,
            'id_pengirim' => $request->id_pengirim,
            'tgl_pengiriman' => $request->tgl_pengiriman,
        ]);

        foreach ($request->items as $item) {
            PembelianItem::create([
                'id_pembelian' => $pembelian->id,
                'id_barang' => $item['id_barang'],
                'qty' => $item['qty'],
                'harga' => $item['harga'],
                'ppn' => $item['ppn'],
            ]);

            if ($pembelian->id_status == 5) {
                $barang = Barang::find($item['id_barang']);
                $barang->stok += $item['qty'];
                $barang->tgl_pengiriman = $request->tgl_pengiriman;
                $barang->save();
            }
        }

        return redirect()->route('pembelian.index')->with('success', 'Pembelian dan Item berhasil disimpan.');
    }

    public function show(Pembelian $pembelian)
    {
        return view('pembelian.show', compact('pembelian'));
    }

    public function edit(Pembelian $pembelian)
    {
        $vendors = Vendor::all();
        $pengirims = Pengirim::all();
        $statuses = Status::all();
        $barangs = Barang::all();
        return view('pembelian.edit', compact('pembelian', 'vendors', 'pengirims', 'statuses', 'barangs'));
    }

    public function update(Request $request, Pembelian $pembelian)
    {
        $request->validate([
            'id_vendor' => 'required|exists:vendors,id',
            'id_status' => 'required|exists:statuses,id',
            'id_pengirim' => 'nullable|exists:pengirims,id',
        ]);

        $previousStatus = $pembelian->id_status;

        $pembelian->update([
            'id_vendor' => $request->id_vendor,
            'id_status' => $request->id_status,
            'id_pengirim' => $request->id_pengirim,
        ]);

        if ($previousStatus != 5 && $pembelian->id_status == 5) {
            // Update stock and set delivery date when status changes to "shipped" (5)
            foreach ($pembelian->items as $item) {
                $barang = Barang::find($item->id_barang);
                $barang->stok += $item->qty;
                $barang->tgl_pengiriman = $pembelian->tgl_pengiriman;
                $barang->save();
            }
        }

        return redirect()->route('pembelian.index')->with('success', 'Pembelian updated successfully.');
    }

    public function destroy(Pembelian $pembelian)
    {
        $pembelian->delete();
        return redirect()->route('pembelian.index')->with('success', 'Pembelian deleted successfully.');
    }

    public function updateStatus(Pembelian $pembelian, $status)
    {
        // Ensure that status cannot be downgraded
        if ($status > $pembelian->id_status) {
            $previousStatus = $pembelian->id_status;
            $pembelian->id_status = $status;
            $pembelian->save();

            // Update stock and set delivery date if status changes to "shipped"
            if ($previousStatus != 5 && $status == 5) {
                foreach ($pembelian->items as $item) {
                    $barang = Barang::find($item->id_barang);
                    $barang->stok += $item->qty;
                    $barang->tgl_pengiriman = $pembelian->tgl_pengiriman;
                    $barang->save();
                }
            }
        }

        return redirect()->route('pembelian.index')->with('success', 'Status updated successfully.');
    }
}
