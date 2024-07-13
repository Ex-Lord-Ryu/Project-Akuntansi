<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detail Pembelian Item') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4">
        <div class="mt-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
            <div class="mb-4">
                <h3 class="text-lg font-semibold">Pembelian ID: {{ $pembelian_item->id_pembelian }}</h3>
            </div>
            <div class="mb-4">
                <p><strong>Barang: </strong>{{ $pembelian_item->barang->nama }}</p>
                <p><strong>Qty: </strong>{{ $pembelian_item->qty }}</p>
                <p><strong>Harga: </strong>{{ $pembelian_item->harga }}</p>
                <p><strong>PPN: </strong>{{ $pembelian_item->ppn }}%</p>
            </div>
            <div class="flex justify-end">
                <a href="{{ route('pembelian_item.index') }}" class="btn btn-primary">Kembali</a>
            </div>
        </div>
    </div>
</x-app-layout>
