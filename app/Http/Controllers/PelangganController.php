<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $query = Pelanggan::where('user_id', $user->id);

        if ($request->has('search')) {
            $search = $request->search;
            $query->where('nama', 'like', '%' . $search . '%')
                  ->orWhere('alamat', 'like', '%' . $search . '%')
                  ->orWhere('tgl_lahir', 'like', '%' . $search . '%')
                  ->orWhere('no_hp', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%')
                  ->orWhere('wilayah', 'like', '%' . $search . '%')
                  ->orWhere('provinsi', 'like', '%' . $search . '%');
        }

        $pelanggan = $query->paginate(10);
        return view('pelanggan.index', compact('pelanggan'));
    }

    public function create(Request $request)
    {
        if ($request->has('from')) {
            session(['pelanggan_create_from' => $request->input('from')]);
        }
        return view('pelanggan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'alamat' => 'required|string',
        ]);

        Pelanggan::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'tgl_lahir' => $request->tgl_lahir,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'wilayah' => $request->wilayah,
            'provinsi' => $request->provinsi,
            'user_id' => auth()->id(), // Link the customer to the current user
        ]);

        $redirectTo = session('pelanggan_create_from', route('pelanggan.index'));
        return redirect($redirectTo)->with('success', 'Pelanggan created successfully.');
    }

    public function show(Pelanggan $pelanggan)
    {
        return view('pelanggan.show', compact('pelanggan'));
    }

    public function edit(Pelanggan $pelanggan)
    {
        return view('pelanggan.edit', compact('pelanggan'));
    }

    public function update(Request $request, Pelanggan $pelanggan)
    {
        $request->validate([
            'nama' => 'required|string',
            'alamat' => 'required|string',
        ]);

        $pelanggan->update($request->all());
        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan updated successfully.');
    }

    public function destroy(Pelanggan $pelanggan)
    {
        $pelanggan->delete();
        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan deleted successfully.');
    }

    // Fungsi untuk menampilkan form pelanggan dari penjualan
    public function createFromPenjualan()
    {
        return view('pelanggan.create_from_penjualan');
    }

    // Fungsi untuk menyimpan pelanggan baru dari form penjualan
    public function storeFromPenjualan(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'tgl_lahir' => 'required|date',
            'no_hp' => 'nullable|string|max:15',
            'email' => 'nullable|email|max:255',
            'wilayah' => 'required|string|max:255',
            'provinsi' => 'required|string|max:255',
        ]);

        Pelanggan::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'tgl_lahir' => $request->tgl_lahir,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'wilayah' => $request->wilayah,
            'provinsi' => $request->provinsi,
            'user_id' => auth()->id(), // Link the customer to the current user
        ]);

        return redirect()->route('penjualan.create')->with('success', 'Pelanggan berhasil ditambahkan.');
    }
}
