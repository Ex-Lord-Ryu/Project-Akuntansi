<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detail Pembelian') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4">
        <div class="mt-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
            <div class="mb-4">
                <h3 class="text-lg font-semibold">Vendor: {{ $pembelian->vendor->nama }}</h3>
            </div>
            <div class="mb-4">
                <p><strong>Tanggal Pembelian: </strong>{{ $pembelian->tgl_pembelian }}</p>
                <p><strong>Status: </strong>{{ $pembelian->status->nama_status }}</p>
                <p><strong>Pengirim: </strong>{{ $pembelian->pengirim->jenis ?? 'N/A' }}</p>
                <p><strong>Tanggal Pengiriman: </strong>{{ $pembelian->tgl_pengiriman ?? 'N/A' }}</p>
            </div>
            <div class="flex justify-end">
                <a href="{{ route('pembelian.index') }}" class="btn btn-primary">Kembali</a>
            </div>
        </div>
    </div>
</x-app-layout>
