<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\PenjualanItem;
use App\Models\Barang;
use App\Models\Pelanggan;
use App\Models\Pengirim;
use App\Models\Status;
use App\Models\Stok;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    public function index()
    {
        $penjualan = Penjualan::with('pelanggan', 'pengirim', 'status')->orderBy('id', 'desc')->paginate(10);
        return view('penjualan.index', compact('penjualan'));
    }

    public function create()
    {
        $pelanggans = Pelanggan::all();
        $pengirims = Pengirim::all();
        $statuses = Status::all();
        $stokAvailable = Stok::where('status', 'available')->get();
        return view('penjualan.create', compact('pelanggans', 'pengirims', 'statuses', 'stokAvailable'));
    }

    public function storeWithItems(Request $request)
    {
        $request->validate([
            'id_pelanggan' => 'required|exists:pelanggan,id',
            'tgl_penjualan' => 'required|date',
            'id_status' => 'required|exists:statuses,id',
            'id_pengirim' => 'nullable|exists:pengirims,id',
            'items' => 'required|array',
            'items.*.stok_id' => 'required|exists:stok,id',
            'items.*.harga' => 'required|numeric',
        ]);

        // Cek apakah pelanggan telah digunakan dalam penjualan sebelumnya
        $existingPenjualan = Penjualan::where('id_pelanggan', $request->id_pelanggan)->first();
        if ($existingPenjualan) {
            return redirect()->route('penjualan.create')->with('error', 'Pelanggan ini sudah pernah digunakan. Silakan buat pelanggan baru.');
        }

        $penjualan = Penjualan::create([
            'id_pelanggan' => $request->id_pelanggan,
            'tgl_penjualan' => $request->tgl_penjualan,
            'id_status' => $request->id_status,
            'id_pengirim' => $request->id_pengirim,
        ]);

        foreach ($request->items as $item) {
            $stok = Stok::find($item['stok_id']);

            if ($stok && $stok->id_barang) {
                PenjualanItem::create([
                    'id_penjualan' => $penjualan->id,
                    'id_barang' => $stok->id_barang,
                    'id_stok' => $stok->id,
                    'id_warna' => $stok->id_warna,
                    'no_rangka' => $stok->no_rangka,
                    'no_mesin' => $stok->no_mesin,
                    'harga' => $item['harga'],
                ]);
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
        $stokAvailable = Stok::where('status', 'available')->get();
        return view('penjualan.edit', compact('penjualan', 'pelanggans', 'pengirims', 'statuses', 'stokAvailable'));
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

        if ($previousStatus != 4 && $penjualan->id_status == 4) {
            foreach ($penjualan->penjualanItems as $item) {
                $stok = Stok::find($item->id_stok);
                $stok->status = 'sold';
                $stok->save();
            }
        }

        return redirect()->route('penjualan.index')->with('success', 'Penjualan updated successfully.');
    }

    public function destroy(Penjualan $penjualan)
    {
        foreach ($penjualan->penjualanItems as $item) {
            $stok = Stok::find($item->id_stok);
            $stok->status = 'available';
            $stok->save();
        }

        $penjualan->delete();
        return redirect()->route('penjualan.index')->with('success', 'Penjualan deleted successfully.');
    }

    public function updateStatus(Penjualan $penjualan, $status)
    {
        if ($penjualan->id_status < $status) {
            $previousStatus = $penjualan->id_status;
            $penjualan->id_status = $status;
            $penjualan->save();

            if ($previousStatus != 4 && $status == 4) {
                foreach ($penjualan->penjualanItems as $item) {
                    $stok = Stok::find($item->id_stok);
                    $stok->status = 'sold';
                    $stok->save();
                }
            }
        }

        return redirect()->route('penjualan.index')->with('success', 'Status updated successfully.');
    }
}
