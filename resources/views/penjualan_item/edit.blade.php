<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Penjualan Item') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4 py-6">
        <form action="{{ route('penjualan_item.update', $penjualan_item->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="id_penjualan" class="block text-sm font-medium text-gray-700">Penjualan</label>
                <select name="id_penjualan" id="id_penjualan" class="form-select mt-1 block w-full">
                    @foreach ($penjualans as $penjualan)
                        <option value="{{ $penjualan->id }}" {{ $penjualan_item->id_penjualan == $penjualan->id ? 'selected' : '' }}>
                            {{ $penjualan->id }}
                        </option>
                    @endforeach
                </select>
                @error('id_penjualan')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="id_barang" class="block text-sm font-medium text-gray-700">Barang</label>
                <select name="id_barang" id="id_barang" class="form-select mt-1 block w-full">
                    @foreach ($barangs as $barang)
                        <option value="{{ $barang->id }}" {{ $penjualan_item->id_barang == $barang->id ? 'selected' : '' }}>
                            {{ $barang->nama }}
                        </option>
                    @endforeach
                </select>
                @error('id_barang')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="id_stok" class="block text-sm font-medium text-gray-700">Stok</label>
                <select name="id_stok" id="id_stok" class="form-select mt-1 block w-full">
                    @foreach ($stoks as $stok)
                        <option value="{{ $stok->id }}" {{ $penjualan_item->id_stok == $stok->id ? 'selected' : '' }}>
                            {{ $stok->id }}
                        </option>
                    @endforeach
                </select>
                @error('id_stok')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="id_warna" class="block text-sm font-medium text-gray-700">Warna</label>
                <input type="text" name="id_warna" id="id_warna" class="form-input mt-1 block w-full" value="{{ $penjualan_item->id_warna }}">
                @error('id_warna')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="no_rangka" class="block text-sm font-medium text-gray-700">No Rangka</label>
                <input type="text" name="no_rangka" id="no_rangka" class="form-input mt-1 block w-full" value="{{ $penjualan_item->no_rangka }}">
                @error('no_rangka')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="no_mesin" class="block text-sm font-medium text-gray-700">No Mesin</label>
                <input type="text" name="no_mesin" id="no_mesin" class="form-input mt-1 block w-full" value="{{ $penjualan_item->no_mesin }}">
                @error('no_mesin')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="harga" class="block text-sm font-medium text-gray-700">Harga</label>
                <input type="number" name="harga" id="harga" class="form-input mt-1 block w-full" value="{{ $penjualan_item->harga }}" required>
                @error('harga')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-light border-custom">Simpan Penjualan Item</button>
            </div>
        </form>
    </div>
</x-app-layout>
