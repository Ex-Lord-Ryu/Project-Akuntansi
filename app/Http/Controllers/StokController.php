<?php

namespace App\Http\Controllers;

use App\Models\Stok;
use App\Models\Warna;
use App\Models\Barang;
use Illuminate\Http\Request;
use Carbon\Carbon;

class StokController extends Controller
{
    // Metode index
    public function index()
    {
        $stok = Stok::with('barang', 'warna') ->orderBy('id', 'desc')->paginate(10);
        return view('stok.index', compact('stok'));
    }

    // Metode create
    public function create()
    {
        $barangs = Barang::all();
        $warnas = Warna::all();
        return view('stok.create', compact('barangs', 'warnas'));
    }

    // Metode store
    public function store(Request $request)
    {
        $request->validate([
            'id_barang' => 'required|exists:barang,id',
            'id_warna' => 'nullable|exists:warna,id',
            'no_rangka' => 'nullable|string|max:50|unique:stok,no_rangka',
            'no_mesin' => 'nullable|string|max:50|unique:stok,no_mesin',
            'harga' => 'nullable|numeric',
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

    // Metode update
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_barang' => 'required|exists:barang,id',
            'id_warna' => 'nullable|exists:warna,id',
            'no_rangka' => 'nullable|string|max:50|unique:stok,no_rangka,' . $id,
            'no_mesin' => 'nullable|string|max:50|unique:stok,no_mesin,' . $id,
            'harga' => 'nullable|numeric',
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

    // Metode destroy
    public function destroy($id)
    {
        $stok = Stok::findOrFail($id);
        $stok->delete();

        return redirect()->route('stok.index')->with('success', 'Stok deleted successfully.');
    }
}
