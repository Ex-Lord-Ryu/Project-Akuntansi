<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detail Penjualan') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4">
        <div class="mt-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
            <div class="mb-4">
                <h3 class="text-lg font-semibold">Pelanggan: {{ $penjualan->pelanggan->nama }}</h3>
            </div>
            <div class="mb-4">
                <p><strong>Tanggal Penjualan: </strong>{{ $penjualan->tgl_penjualan }}</p>
                <p><strong>Status: </strong>{{ $penjualan->status->nama_status }}</p>
                <p><strong>Pengirim: </strong>{{ $penjualan->pengirim->jenis ?? 'N/A' }}</p>
                <p><strong>Tanggal Pengiriman: </strong>{{ $penjualan->tgl_pengiriman ?? 'N/A' }}</p>
            </div>
            <div class="flex justify-end">
                <a href="{{ route('penjualan.index') }}" class="btn btn-primary">Kembali</a>
            </div>
        </div>
    </div>
</x-app-layout>
