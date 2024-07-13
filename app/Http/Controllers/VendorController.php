<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function index()
    {
        // Dapatkan data vendor dengan paginasi
        $vendors = Vendor::paginate(10);
        return view('vendor.index', compact('vendors'));
    }

    public function create()
    {
        return view('vendor.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'alamat' => 'required|string',
        ]);

        Vendor::create($request->all());
        return redirect()->route('vendor.index')
                         ->with('success', 'Vendor created successfully.');
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
        return redirect()->route('vendor.index')
                         ->with('success', 'Vendor updated successfully.');
    }

    public function destroy(Vendor $vendor)
    {
        $vendor->delete();
        return redirect()->route('vendor.index')
                         ->with('success', 'Vendor deleted successfully.');
    }
}
