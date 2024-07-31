<?php

namespace App\Http\Controllers;

use App\Models\Stok;
use App\Models\Status;
use App\Models\Pengirim;
use App\Models\Pelanggan;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use App\Models\PenjualanItem;
use Illuminate\Support\Facades\Log;

class PenjualanController extends Controller
{
    public function index(Request $request)
    {
        $query = Penjualan::with('pelanggan', 'pengirim', 'status')->orderBy('id', 'desc');

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->whereHas('pelanggan', function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%");
            })
            ->orWhereHas('pengirim', function ($q) use ($search) {
                $q->where('jenis', 'like', "%{$search}%");
            })
            ->orWhere('tgl_penjualan', 'like', "%{$search}%")
            ->orWhere('id', 'like', "%{$search}%");
        }

        $penjualan = $query->paginate(10);

        return view('penjualan.index', compact('penjualan'));
    }

    public function create()
    {
        $user = auth()->user();
        $pelanggans = Pelanggan::where('user_id', $user->id)->get(); // Filter customers by the logged-in user
        $pengirims = Pengirim::where('jenis', 'pick up')->get(); // Only include "pick up" option
        $statuses = Status::all();
        $stokGrouped = Stok::where('status', 'available')
            ->where('harga', '>', 0)
            ->get()
            ->groupBy('barang.nama');
        // Only get available stock with a non-zero price
        $stokAvailable = Stok::where('status', 'available')->where('harga', '>', 0)->get();
        return view('penjualan.create', compact('pelanggans', 'pengirims', 'statuses', 'stokAvailable', 'stokGrouped'));
    }

    public function storeWithItems(Request $request)
    {
        $validatedData = $request->validate([
            'id_pelanggan' => 'required|exists:pelanggan,id',
            'tgl_penjualan' => 'required|date',
            'id_status' => 'required|exists:statuses,id',
            'id_pengirim' => 'nullable|exists:pengirims,id',
            'tgl_penerimaan' => 'required|date',
            'items' => 'required|array',
            'items.*.stok_id' => 'required|exists:stok,id',
            'items.*.harga' => 'required|numeric',
            'items.*.no_rangka' => 'required|string',
            'items.*.no_mesin' => 'required|string',
            'items.*.metode_pembayaran' => 'required|string',
        ]);

        // Check if the customer belongs to the logged-in user
        $customer = Pelanggan::where('id', $validatedData['id_pelanggan'])
            ->where('user_id', auth()->id())
            ->first();

        if (!$customer) {
            return redirect()->route('penjualan.create')->with('error', 'Pelanggan tidak valid.');
        }

        $penjualan = Penjualan::create([
            'user_id' => auth()->id(),
            'id_pelanggan' => $validatedData['id_pelanggan'],
            'tgl_penjualan' => $validatedData['tgl_penjualan'],
            'id_status' => $validatedData['id_status'],
            'id_pengirim' => $validatedData['id_pengirim'],
            'tgl_penerimaan' => $validatedData['tgl_penerimaan'],
        ]);

        foreach ($validatedData['items'] as $item) {
            $stok = Stok::find($item['stok_id']);

            if ($stok && $stok->id_barang) {
                PenjualanItem::create([
                    'id_penjualan' => $penjualan->id,
                    'id_barang' => $stok->id_barang,
                    'id_stok' => $stok->id,
                    'id_warna' => $stok->id_warna,
                    'no_rangka' => $item['no_rangka'],
                    'no_mesin' => $item['no_mesin'],
                    'harga' => $item['harga'],
                    'metode_pembayaran' => $item['metode_pembayaran'],
                ]);
            }
        }

        return $this->redirectTo();
    }

    public function show($id)
    {
        $penjualan = Penjualan::with('pelanggan', 'pengirim', 'status', 'penjualanItems')->findOrFail($id);
        return view('penjualan.show', compact('penjualan'));
    }

    public function edit($id)
    {
        $penjualan = Penjualan::with('pelanggan', 'pengirim', 'status', 'penjualanItems')->findOrFail($id);
        $user = auth()->user();
        $pelanggans = Pelanggan::where('user_id', $user->id)->get(); // Filter customers by the logged-in user
        $pengirims = Pengirim::where('jenis', 'pick up')->get(); // Only include "pick up" option
        $statuses = Status::all();
        $stokGrouped = Stok::where('status', 'available')
            ->where('harga', '>', 0)
            ->get()
            ->groupBy('barang.nama');
        $stokAvailable = Stok::where('status', 'available')->where('harga', '>', 0)->get(); // Only get available stock with a non-zero price
    
        return view('penjualan.edit', compact('pelanggans', 'pengirims', 'statuses', 'stokAvailable', 'stokGrouped', 'penjualan'));
    }


    public function update(Request $request, Penjualan $penjualan)
    {
        $request->validate([
            'id_pelanggan' => 'required|exists:pelanggan,id',
            'id_status' => 'required|exists:statuses,id',
            'id_pengirim' => 'nullable|exists:pengirims,id',
            'tgl_penerimaan' => 'required|date',
        ]);

        // Check if the customer belongs to the logged-in user
        $customer = Pelanggan::where('id', $request->id_pelanggan)
            ->where('user_id', auth()->id())
            ->first();

        if (!$customer) {
            return redirect()->route('penjualan.edit', $penjualan->id)->with('error', 'Pelanggan tidak valid.');
        }

        $previousStatus = $penjualan->id_status;

        $penjualan->update([
            'id_pelanggan' => $request->id_pelanggan,
            'id_status' => $request->id_status,
            'id_pengirim' => $request->id_pengirim,
            'tgl_penerimaan' => $request->tgl_penerimaan,
        ]);

        if ($previousStatus != 4 && $penjualan->id_status == 4) {
            foreach ($penjualan->penjualanItems as $item) {
                $stok = Stok::find($item->id_stok);
                $stok->status = 'sold';
                $stok->save();
            }
        }

        return $this->redirectTo();
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

    public function updateStatus(Request $request, Penjualan $penjualan, $status)
    {
        if ($penjualan->id_status < $status) {
            $previousStatus = $penjualan->id_status;
            $penjualan->update(['id_status' => $status]);

            if ($previousStatus != 4 && $status == 4) {
                foreach ($penjualan->penjualanItems as $item) {
                    $stok = Stok::find($item->id_stok);
                    if ($stok) {
                        $stok->update(['status' => 'sold']);
                    }
                }
            }
        }
        return response()->json(['success' => true]);
    }

    public function riwayatPenjualan()
    {
        $user = auth()->user();

        if ($user->usertype === 'admin') {
            // Jika admin, tampilkan semua penjualan
            $penjualans = Penjualan::with('pelanggan', 'status', 'pengirim')->paginate(10);
        } else {
            // Jika bukan admin, tampilkan penjualan milik user tersebut
            $penjualans = Penjualan::where('user_id', $user->id)
                ->with('pelanggan', 'status', 'pengirim')
                ->paginate(10);
        }

        return view('penjualan.riwayat', compact('penjualans'));
    }



    private function redirectTo()
    {
        $user = auth()->user();
        if ($user->usertype === 'admin') {
            return redirect()->route('penjualan.index')->with('success', 'Penjualan berhasil disimpan.');
        } else {
            return redirect()->route('dashboard')->with('success', 'Penjualan berhasil disimpan.');
        }
    }
}
