<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detail Penjualan') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4 py-6">
        <div class="mb-4">
            <label for="id_pelanggan" class="block text-sm font-medium text-gray-700">Pelanggan</label>
            <p class="mt-1">{{ $penjualan->pelanggan->nama }}</p>
        </div>

        <div class="mb-4">
            <label for="tgl_penjualan" class="block text-sm font-medium text-gray-700">Tanggal Penjualan</label>
            <p class="mt-1">{{ $penjualan->tgl_penjualan }}</p>
        </div>

        <div class="mb-4">
            <label for="id_status" class="block text-sm font-medium text-gray-700">Status</label>
            <p class="mt-1">{{ $penjualan->status->nama_status }}</p>
        </div>

        <div class="mb-4">
            <label for="id_pengirim" class="block text-sm font-medium text-gray-700">Pengirim</label>
            <p class="mt-1">{{ $penjualan->pengirim->jenis ?? 'N/A' }}</p>
        </div>

        <div class="mb-4">
            <label for="tgl_pengiriman" class="block text-sm font-medium text-gray-700">Tanggal Pengiriman</label>
            <p class="mt-1">{{ $penjualan->tgl_pengiriman ?? 'N/A' }}</p>
        </div>

        <div class="mt-6">
            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Item Penjualan</h3>
            <div class="mt-4">
                @foreach ($penjualan->items as $item)
                    <div class="mb-4">
                        <div class="flex space-x-4">
                            <div class="w-1/4">
                                <label for="stok_id" class="block text-sm font-medium text-gray-700">Stok</label>
                                <p class="mt-1">{{ $item->stok->barang->nama }} - {{ $item->stok->no_rangka }}</p>
                            </div>
                            <div class="w-1/4">
                                <label for="harga" class="block text-sm font-medium text-gray-700">Harga</label>
                                <p class="mt-1">{{ $item->harga }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="mt-4">
            <a href="{{ route('penjualan.index') }}" class="btn btn-light border-custom">Kembali</a>
        </div>
    </div>
</x-app-layout>
