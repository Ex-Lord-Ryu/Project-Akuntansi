<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    public function index(Request $request)
    {
        $query = Barang::query();

        if ($request->has('search')) {
            $search = $request->search;
            $query->where('nama', 'like', '%' . $search . '%');
        }

        $barang = $query->paginate(10);
        return view('barang.index', compact('barang'));
    }

    public function create()
    {
        return view('barang.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');

            if ($file->isValid()) {
                $extension = $file->getClientOriginalExtension();
                $imageName = time() . '.' . $extension;
                $destinationPath = storage_path('app/public/images');

                // Ensure the destination directory exists
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }

                // Move the file
                try {
                    $file->move($destinationPath, $imageName);
                    $validatedData['image'] = $imageName;
                } catch (\Exception $e) {
                    return redirect()->back()->withErrors(['image' => 'Failed to upload the image. Please try again.']);
                }
            } else {
                return redirect()->back()->withErrors(['image' => 'Uploaded file is not valid.']);
            }
        }

        Barang::create($validatedData);

        return redirect()->route('barang.index')->with('success', 'Barang created successfully.');
    }


    public function edit(Barang $barang)
    {
        return view('barang.edit', compact('barang'));
    }

    public function update(Request $request, Barang $barang)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');

            if ($file->isValid()) {
                // Delete the old image if it exists
                if ($barang->image) {
                    $oldImagePath = storage_path('app/public/images/' . $barang->image);
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }

                $extension = $file->getClientOriginalExtension();
                $imageName = time() . '.' . $extension;
                $destinationPath = storage_path('app/public/images');

                // Ensure the destination directory exists
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }

                // Move the file
                try {
                    $file->move($destinationPath, $imageName);
                    $validatedData['image'] = $imageName;
                } catch (\Exception $e) {
                    return redirect()->back()->withErrors(['image' => 'Failed to upload the image. Please try again.']);
                }
            } else {
                return redirect()->back()->withErrors(['image' => 'Uploaded file is not valid.']);
            }
        }

        $barang->update($validatedData);

        return redirect()->route('barang.index')->with('success', 'Barang updated successfully.');
    }

    public function showDetail($id)
    {
        $barang = Barang::with(['warna', 'stok'])->findOrFail($id);
        return view('detail', compact('barang'));
    }


    public function destroy(Barang $barang)
    {
        if ($barang->image) {
            Storage::disk('public')->delete('images/' . $barang->image);
        }

        $barang->delete();
        return redirect()->route('barang.index')->with('success', 'Barang deleted successfully.');
    }
}
