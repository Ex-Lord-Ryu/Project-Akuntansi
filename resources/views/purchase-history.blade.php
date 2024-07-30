<!-- resources/views/purchase-history.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Riwayat Pembelian') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4 py-6">
        <div class="mt-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
            <h3 class="text-lg font-medium text-gray-800 dark:text-gray-200">Riwayat Pembelian Anda</h3>
            @if(empty($purchaseHistory) || $purchaseHistory->isEmpty())
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Tanggal Penjualan</th>
                            <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Model</th>
                            <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Warna</th>
                            <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Pembayaran</th>
                            <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Harga</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-600">
                        <tr>
                            <td colspan="4" class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium text-gray-500 dark:text-gray-300">
                                Tidak ada riwayat pembelian
                            </td>
                        </tr>
                    </tbody>
                </table>
            @else
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Tanggal Penjualan</th>
                            <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Model</th>
                            <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Warna</th>
                            <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Pembayaran</th>
                            <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Harga</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-600">
                        @foreach ($purchaseHistory as $penjualan)
                            @foreach ($penjualan->penjualanItems as $item)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $penjualan->tgl_penjualan }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $item->barang->nama }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $item->warna->warna }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $item->warna->warna }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $item->harga }}</td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</x-app-layout>
