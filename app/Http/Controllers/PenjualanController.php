<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\PenjualanItem;
use App\Models\Barang;
use App\Models\Pelanggan;
use App\Models\Pengirim;
use App\Models\Status;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    public function index()
    {
        $penjualan = Penjualan::with('pelanggan', 'pengirim', 'status')->paginate(10);
        return view('penjualan.index', compact('penjualan'));
    }

    public function create()
    {
        $pelanggans = Pelanggan::all();
        $pengirims = Pengirim::all();
        $statuses = Status::all();
        $barangs = Barang::all();
        return view('penjualan.create', compact('pelanggans', 'pengirims', 'statuses', 'barangs'));
    }

    public function storeWithItems(Request $request)
    {
        $request->validate([
            'id_pelanggan' => 'required|exists:pelanggan,id',
            'tgl_penjualan' => 'required|date',
            'id_status' => 'required|exists:statuses,id',
            'id_pengirim' => 'nullable|exists:pengirims,id',
            'items' => 'required|array',
            'items.*.id_barang' => 'required|exists:barang,id',
            'items.*.qty' => 'required|integer',
            'items.*.harga' => 'required|numeric',
            'items.*.ppn' => 'required|integer'
        ]);

        $penjualan = Penjualan::create([
            'id_pelanggan' => $request->id_pelanggan,
            'tgl_penjualan' => $request->tgl_penjualan,
            'id_status' => $request->id_status,
            'id_pengirim' => $request->id_pengirim,
        ]);

        foreach ($request->items as $item) {
            PenjualanItem::create([
                'penjualan_id' => $penjualan->id,
                'barang_id' => $item['id_barang'],
                'qty' => $item['qty'],
                'harga' => $item['harga'],
                'ppn' => $item['ppn'],
            ]);

            if ($penjualan->id_status == 5) {
                $barang = Barang::find($item['id_barang']);
                $barang->stok -= $item['qty']; // Subtract stock for sales
                $barang->tgl_penjualan = $request->tgl_penjualan; // Set the sale date
                $barang->save();
            }
        }

        return redirect()->route('penjualan.index')->with('success', 'Penjualan dan Item berhasil disimpan.');
    }

    public function show(Penjualan $penjualan)
    {
        return view('penjualan.show', compact('penjualan'));
    }

    public function edit(Penjualan $penjualan)
    {
        $pelanggans = Pelanggan::all();
        $pengirims = Pengirim::all();
        $statuses = Status::all();
        $barangs = Barang::all();
        return view('penjualan.edit', compact('penjualan', 'pelanggans', 'pengirims', 'statuses', 'barangs'));
    }

    public function update(Request $request, Penjualan $penjualan)
    {
        $request->validate([
            'id_pelanggan' => 'required|exists:pelanggan,id',
            'id_status' => 'required|exists:statuses,id',
            'id_pengirim' => 'nullable|exists:pengirims,id',
        ]);

        $previousStatus = $penjualan->id_status;

        $penjualan->update([
            'id_pelanggan' => $request->id_pelanggan,
            'id_status' => $request->id_status,
            'id_pengirim' => $request->id_pengirim,
        ]);

        if ($previousStatus != 5 && $penjualan->id_status == 5) {
            foreach ($penjualan->penjualanItems as $item) {
                $barang = Barang::find($item->barang_id);
                $barang->stok -= $item->qty; // Subtract stock for sales
                $barang->tgl_penjualan = $penjualan->tgl_penjualan; // Set the sale date
                $barang->save();
            }
        }

        return redirect()->route('penjualan.index')->with('success', 'Penjualan updated successfully.');
    }

    public function destroy(Penjualan $penjualan)
    {
        $penjualan->delete();
        return redirect()->route('penjualan.index')->with('success', 'Penjualan deleted successfully.');
    }

    public function updateStatus(Penjualan $penjualan, $status)
    {
        if ($penjualan->id_status < $status) {
            $previousStatus = $penjualan->id_status;
            $penjualan->id_status = $status;
            $penjualan->save();

            if ($previousStatus != 5 && $status == 5) {
                foreach ($penjualan->penjualanItems as $item) {
                    $barang = Barang::find($item->barang_id);
                    if ($barang) {
                        $barang->stok -= $item->qty; // Subtract stock for sales
                        $barang->tgl_penjualan = $penjualan->tgl_penjualan; // Set the sale date
                        $barang->save();
                    } else {
                        // Debugging output
                        dd('Barang not found', $item);
                    }
                }
            }
        }

        return redirect()->route('penjualan.index')->with('success', 'Status updated successfully.');
    }
}
