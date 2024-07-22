<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detail Pembelian') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4">
        <div class="mt-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Vendor</label>
                <p class="text-lg font-semibold">{{ $pembelian->vendor->nama }}</p>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal Pembelian</label>
                <p class="text-lg font-semibold">{{ $pembelian->tgl_pembelian }}</p>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                <p class="text-lg font-semibold">{{ $pembelian->status->nama_status }}</p>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Pengirim</label>
                <p class="text-lg font-semibold">{{ $pembelian->pengirim->jenis ?? 'N/A' }}</p>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal Pengiriman</label>
                <p class="text-lg font-semibold">{{ $pembelian->tgl_pengiriman ?? 'N/A' }}</p>
            </div>
            <div class="mt-6">
                <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Items</h3>
                <table class="min-w-full divide-y divide-gray-200 mt-4">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Barang
                            </th>
                            <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Warna
                            </th>
                            <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Harga
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200">
                        @foreach ($pembelian->items as $item)
                            <tr>
                                <td class="px-6 py-4 whitespace-no-wrap text-sm font-medium text-gray-900 dark:text-gray-100">
                                    {{ $item->barang->nama }}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap text-sm text-gray-500 dark:text-gray-300">
                                    {{ $item->warna->warna ?? 'N/A' }}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap text-sm text-gray-500 dark:text-gray-300">
                                    {{ number_format($item->harga, 0, ',', '.') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-6 flex justify-end">
                <a href="{{ route('pembelian.index') }}" class="btn btn-dark">Kembali</a>
            </div>
        </div>
    </div>
</x-app-layout>
