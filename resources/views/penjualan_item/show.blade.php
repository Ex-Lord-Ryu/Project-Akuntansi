<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detail Penjualan Item') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4 py-6">
        <div class="mb-4">
            <label for="id_penjualan" class="block text-sm font-medium text-gray-700">ID Penjualan</label>
            <p class="mt-1">{{ $penjualan_item->id_penjualan }}</p>
        </div>

        <div class="mb-4">
            <label for="id_barang" class="block text-sm font-medium text-gray-700">Barang</label>
            <p class="mt-1">{{ $penjualan_item->barang ? $penjualan_item->barang->nama : 'N/A' }}</p>
        </div>

        <div class="mb-4">
            <label for="id_stok" class="block text-sm font-medium text-gray-700">Stok</label>
            <p class="mt-1">{{ $penjualan_item->stok ? $penjualan_item->stok->id : 'N/A' }}</p>
        </div>

        <div class="mb-4">
            <label for="id_warna" class="block text-sm font-medium text-gray-700">Warna</label>
            <p class="mt-1">{{ $penjualan_item->id_warna }}</p>
        </div>

        <div class="mb-4">
            <label for="no_rangka" class="block text-sm font-medium text-gray-700">No Rangka</label>
            <p class="mt-1">{{ $penjualan_item->no_rangka }}</p>
        </div>

        <div class="mb-4">
            <label for="no_mesin" class="block text-sm font-medium text-gray-700">No Mesin</label>
            <p class="mt-1">{{ $penjualan_item->no_mesin }}</p>
        </div>

        <div class="mb-4">
            <label for="harga" class="block text-sm font-medium text-gray-700">Harga</label>
            <p class="mt-1">{{ $penjualan_item->harga }}</p>
        </div>

        <div class="mt-4">
            <a href="{{ route('penjualan_item.index') }}" class="btn btn-light border-custom">Kembali</a>
        </div>
    </div>
</x-app-layout>
