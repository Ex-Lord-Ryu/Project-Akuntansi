<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function index(Request $request)
    {
        $query = Vendor::query();

        if ($request->has('search')) {
            $query->where('nama', 'like', '%' . $request->search . '%')
                  ->orWhere('alamat', 'like', '%' . $request->search . '%');
        }

        $vendors = $query->paginate(10);
        return view('vendor.index', compact('vendors'));
    }

    public function create(Request $request)
    {
        if ($request->has('from')) {
            session(['vendor_create_from' => $request->input('from')]);
        }
        return view('vendor.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'alamat' => 'required|string',
        ]);

        Vendor::create($request->all());

        $redirectTo = session('vendor_create_from', route('vendor.index'));
        return redirect($redirectTo)->with('success', 'Vendor created successfully.');
    }

    public function show(Vendor $vendor)
    {
        return view('vendor.show', compact('vendor'));
    }

    public function edit(Vendor $vendor)
    {
        return view('vendor.edit', compact('vendor'));
    }

    public function update(Request $request, Vendor $vendor)
    {
        $request->validate([
            'nama' => 'required|string',
            'alamat' => 'required|string',
        ]);

        $vendor->update($request->all());
        return redirect()->route('vendor.index')->with('success', 'Vendor updated successfully.');
    }

    public function destroy(Vendor $vendor)
    {
        $vendor->delete();
        return redirect()->route('vendor.index')->with('success', 'Vendor deleted successfully.');
    }

    // Fungsi untuk menampilkan form vendor dari pembelian
    public function createFromPembelian()
    {
        return view('vendor.create_from_pembelian');
    }

    // Fungsi untuk menyimpan vendor baru dari form pembelian
    public function storeFromPembelian(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
        ]);

        Vendor::create($request->all());

        return redirect()->route('pembelian.create')->with('success', 'Vendor berhasil ditambahkan.');
    }
}
