<?php

namespace App\Http\Controllers;

use \Illuminate\Support\Facades\Log;
use App\Models\Stok;
use App\Models\Status;
use App\Models\Pengirim;
use App\Models\Pelanggan;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use App\Models\PenjualanItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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
        $pelanggans = Pelanggan::where('user_id', $user->id)->get();
        $pengirims = Pengirim::where('jenis', 'pick up')->get();
        $statuses = Status::all();
        $stokGrouped = Stok::where('status', 'available')
            ->where('harga', '>', 0)
            ->get()
            ->groupBy('barang.nama');

            $stokAvailable = Stok::where('status', 'available')->where('harga', '>', 0)->get();
        return view('penjualan.create', compact('pelanggans', 'pengirims', 'statuses', 'stokGrouped', 'stokAvailable'));
    }


    public function storeWithItems(Request $request)
    {
        Log::info('StoreWithItems: Request received', $request->all());
    
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
    
        Log::info('StoreWithItems: Validation passed', $validatedData);
    
        // Check if the customer belongs to the logged-in user
        $customer = Pelanggan::where('id', $validatedData['id_pelanggan'])
            ->where('user_id', auth()->id())
            ->first();
    
        if (!$customer) {
            Log::error('StoreWithItems: Invalid customer');
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
    
        Log::info('StoreWithItems: Penjualan created', ['penjualan_id' => $penjualan->id]);
    
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
    
                $stok->update(['status' => 'dipesan']);
                Log::info('StoreWithItems: PenjualanItem created and stock updated', ['stok_id' => $stok->id]);
            }
        }
    
        return $this->redirectTo();
    }
    
    public function edit($id)
    {
        $penjualan = Penjualan::with('pelanggan', 'pengirim', 'status', 'penjualanItems')->findOrFail($id);
        $user = auth()->user();
        $pelanggans = Pelanggan::where('user_id', $user->id)->get();
        $pengirims = Pengirim::where('jenis', 'pick up')->get();
        $statuses = Status::all();
        $stokGrouped = Stok::where('status', 'available')
            ->where('harga', '>', 0)
            ->get()
            ->groupBy('barang.nama');
            $stokAvailable = Stok::where('status', 'available')->where('harga', '>', 0)->get();
        return view('penjualan.edit', compact('pelanggans', 'pengirims', 'statuses', 'stokGrouped', 'penjualan', 'stokAvailable'));
    }

    public function update(Request $request, Penjualan $penjualan)
    {
        $request->validate([
            'id_pelanggan' => 'required|exists:pelanggan,id',
            'id_status' => 'required|exists:statuses,id',
            'id_pengirim' => 'nullable|exists:pengirims,id',
            'tgl_penerimaan' => 'required|date',
        ]);

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

    private function redirectTo()
    {
        $user = Auth::user();
        if ($user->usertype === 'admin') {
            return redirect()->route('penjualan.index')->with('success', 'Penjualan berhasil disimpan.');
        } else {
            return redirect()->route('dashboard')->with('success', 'Penjualan berhasil disimpan.');
        }
    }

    public function show($id)
    {
        $penjualan = Penjualan::with('pelanggan', 'pengirim', 'status', 'penjualanItems')->findOrFail($id);
        return view('penjualan.show', compact('penjualan'));
    }

    public function riwayatPenjualan()
    {
        $user = auth()->user();
    
        if ($user->usertype === 'admin') {
            // Jika admin, tampilkan semua penjualan
            $penjualans = Penjualan::with(['pelanggan', 'status', 'pengirim', 'penjualanItems.barang', 'penjualanItems.warna'])->paginate(10);
        } else {
            // Jika bukan admin, tampilkan penjualan milik user tersebut
            $penjualans = Penjualan::where('user_id', $user->id)
                ->with(['pelanggan', 'status', 'pengirim', 'penjualanItems.barang', 'penjualanItems.warna'])
                ->paginate(10);
        }
    
        return view('penjualan.riwayat', compact('penjualans'));
    }


    public function cancel($id)
    {
        $penjualan = Penjualan::findOrFail($id);

        foreach ($penjualan->penjualanItems as $item) {
            $stok = Stok::find($item->id_stok);
            if ($stok) {
                $stok->update([
                    'status' => 'available',
                    'user_id' => null,
                ]);
            }
        }

        $penjualan->delete();
    }

public function updateStatus(Request $request, $id, $status)
{
    $penjualan = Penjualan::with('penjualanItems')->findOrFail($id);

    // Check if status is 4 and update stock status
    if ($status == 4) {
        $pelanggan = Pelanggan::find($penjualan->id_pelanggan);
        if (!$pelanggan) {
            return response()->json(['success' => false, 'message' => 'Pelanggan tidak ditemukan']);
        }

        foreach ($penjualan->penjualanItems as $item) {
            $stok = Stok::find($item->id_stok);
            if ($stok) {
                // Ensure user_id exists in users table
                $userExists = DB::table('users')->where('id', $pelanggan->user_id)->exists();
                if ($userExists) {
                    $stok->update([
                        'status' => 'sold',
                        'user_id' => $pelanggan->user_id,
                    ]);
                } else {
                    return response()->json(['success' => false, 'message' => 'User ID tidak valid']);
                }
            }
        }
    }

    // Update penjualan status
    $penjualan->update([
        'id_status' => $status,
    ]);

    return response()->json(['success' => true]);
}

}
