<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detail Penjualan Item') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4">
        <div class="mt-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
            <div class="mb-4">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-200">Informasi Penjualan</h3>
                <p>ID Penjualan: {{ $penjualanItem->penjualan->id }}</p>
                <p>Nama Pelanggan: {{ $penjualanItem->penjualan->pelanggan->nama }}</p>
                <p>Tanggal Penjualan: {{ $penjualanItem->penjualan->tgl_penjualan }}</p>
            </div>
            <div class="mb-4">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-200">Detail Barang</h3>
                <p>Nama Barang: {{ $penjualanItem->barang->nama }}</p>
                <p>Warna: {{ $penjualanItem->warna->warna ?? 'N/A' }}</p>
                <p>No Rangka: {{ $penjualanItem->no_rangka }}</p>
                <p>No Mesin: {{ $penjualanItem->no_mesin }}</p>
                <p>Harga: {{ 'Rp ' . number_format($penjualanItem->harga, 0, ',', '.') }}</p>
            </div>
        </div>
    </div>
</x-app-layout>
