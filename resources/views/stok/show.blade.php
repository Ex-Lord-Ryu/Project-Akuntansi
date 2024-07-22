<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detail Stok') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4">
        <div class="mt-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
            <div class="mb-4">
                <h3 class="text-lg font-semibold">Detail Stok</h3>
            </div>
            <div class="mb-4">
                <p><strong>Nama Barang: </strong>{{ $stok->barang->nama }}</p>
                <p><strong>Warna: </strong>{{ $stok->warna->warna ?? 'N/A' }}</p>
                <p><strong>No Rangka: </strong>{{ $stok->no_rangka }}</p>
                <p><strong>No Mesin: </strong>{{ $stok->no_mesin }}</p>
                <p><strong>Harga: </strong>{{ $stok->harga }}</p>
            </div>
            <div class="flex justify-end">
                <a href="{{ route('stok.index') }}" class="btn btn-primary">Kembali</a>
            </div>
        </div>
    </div>
</x-app-layout>
