<?php

namespace App\Http\Controllers;

use App\Models\Stok;
use App\Models\Warna;
use App\Models\Barang;
use Illuminate\Http\Request;
use Carbon\Carbon;

class StokController extends Controller
{
    public function index(Request $request)
    {
        $query = Stok::query();

        if ($request->has('search')) {
            $search = $request->search;

            $query->whereHas('barang', function ($q) use ($search) {
                $q->where('nama', 'like', '%' . $search . '%');
            })->orWhere('no_rangka', 'like', '%' . $search . '%')
                ->orWhere('no_mesin', 'like', '%' . $search . '%')
                ->orWhere('tgl_penerimaan', 'like', '%' . $search . '%');
        }

        $stok = $query->with('barang', 'warna')->orderBy('id', 'desc')->paginate(10);
        return view('stok.index', compact('stok'));
    }

    // Metode create
    public function create()
    {
        $barangs = Barang::all();
        $warnas = Warna::all();
        return view('stok.create', compact('barangs', 'warnas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_barang' => 'required|exists:barang,id',
            'id_warna' => 'nullable|exists:warna,id',
            'no_rangka' => 'nullable|string|max:50|unique:stok,no_rangka|min:17',
            'no_mesin' => 'nullable|string|max:50|unique:stok,no_mesin|min:17',
            'harga' => 'nullable|numeric',
        ], [
            'no_rangka.unique' => 'No Rangka sudah ada.',
            'no_mesin.unique' => 'No Mesin sudah ada.',
        ]);

        $data = $request->all();
        $data['tgl_penerimaan'] = Carbon::now()->toDateString();

        Stok::create($data);

        return redirect()->route('stok.index')->with('success', 'Stok created successfully.');
    }

    // Metode edit
    public function edit($id)
    {
        $stok = Stok::findOrFail($id);
        $barangs = Barang::all();
        $warnas = Warna::all();
        return view('stok.edit', compact('stok', 'barangs', 'warnas'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_barang' => 'required|exists:barang,id',
            'id_warna' => 'nullable|exists:warna,id',
            'no_rangka' => 'nullable|string|max:50|min:17|unique:stok,no_rangka,' . $id,
            'no_mesin' => 'nullable|string|max:50|min:17|unique:stok,no_mesin,' . $id,
            'harga' => 'nullable|numeric',
        ], [
            'no_rangka.unique' => 'No Rangka sudah ada.',
            'no_mesin.unique' => 'No Mesin sudah ada.',
        ]);

        $stok = Stok::findOrFail($id);
        $data = $request->all();
        $data['tgl_penerimaan'] = Carbon::now()->toDateString();

        $stok->update($data);

        return redirect()->route('stok.index')->with('success', 'Stok updated successfully.');
    }

    // Metode show
    public function show($id)
    {
        $stok = Stok::with('barang', 'warna')->findOrFail($id);
        return view('stok.show', compact('stok'));
    }

    public function getStokByBarangAndWarna($barang_id, $warna_id)
    {
        $stok = Stok::where('barang_id', $barang_id)
            ->where('warna_id', $warna_id)
            ->where('harga', '>', 0)
            ->get();
        return response()->json($stok);
    }

    public function showDetail($id)
    {
        // Fetch the barang along with related stok and warna
        $barang = Barang::with(['stok.warna'])->findOrFail($id);
        $stok = Stok::where('id_barang', $id)->get();

        // Get all unique colors and latest price from the stok table
        $colors = $stok->pluck('warna.warna')->unique()->implode(', ');
        $latestPrice = $stok->max('harga');

        return view('detail', compact('barang', 'colors', 'latestPrice', 'stok'));
    }


    // Metode destroy
    public function destroy($id)
    {
        $stok = Stok::findOrFail($id);
        $stok->delete();

        return redirect()->route('stok.index')->with('success', 'Stok deleted successfully.');
    }
}
