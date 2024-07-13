<?php

namespace App\Http\Controllers;

use App\Models\Pengirim;
use Illuminate\Http\Request;

class PengirimController extends Controller
{
    public function index()
    {
        $pengirim = Pengirim::all();
        return view('pengirim.index', compact('pengirim'));
    }

    public function create()
    {
        return view('pengirim.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis' => 'required|string',
        ]);

        Pengirim::create($request->all());
        return redirect()->route('pengirim.index')
                         ->with('success', 'Pengirim created successfully.');
    }

    public function show(Pengirim $pengirim)
    {
        return view('pengirim.show', compact('pengirim'));
    }

    public function edit(Pengirim $pengirim)
    {
        return view('pengirim.edit', compact('pengirim'));
    }

    public function update(Request $request, Pengirim $pengirim)
    {
        $request->validate([
            'jenis' => 'required|string',
        ]);

        $pengirim->update($request->all());
        return redirect()->route('pengirim.index')
                         ->with('success', 'Pengirim updated successfully.');
    }

    public function destroy(Pengirim $pengirim)
    {
        $pengirim->delete();
        return redirect()->route('pengirim.index')
                         ->with('success', 'Pengirim deleted successfully.');
    }
}
