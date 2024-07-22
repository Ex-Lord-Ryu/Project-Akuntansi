<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detail Pembelian Item') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4">
        <div class="mt-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
            <div class="mb-4">
                <h3 class="text-lg font-semibold">Pembelian ID: {{ $pembelianItem->id_pembelian }}</h3>
            </div>
            <div class="mb-4">
                <p><strong>Barang: </strong>{{ $pembelianItem->barang->nama }}</p>
                <p><strong>Warna: </strong>{{ $pembelianItem->warna->warna ?? 'N/A' }}</p>
                <p><strong>Harga: </strong>{{ $pembelianItem->harga }}</p>
            </div>
            <div class="flex justify-between items-center">
                <a href="{{ route('pembelian_item.index') }}" class="btn btn-dark">Back</a>
            </div>
        </div>
    </div>
</x-app-layout>
