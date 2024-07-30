<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detail Pembelian') }}
        </h2>
    </x-slot>

    <link rel="stylesheet" href="{{ asset('assets/css/btn.css') }}">

    <div class="container mx-auto px-4">
        <div class="mt-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th colspan="2" class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Informasi Pembelian
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200">
                    <tr>
                        <td class="px-6 py-4 whitespace-no-wrap text-sm font-medium text-gray-700 dark:text-gray-300">
                            Vendor
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap text-sm text-gray-900 dark:text-gray-100">
                            {{ $pembelian->vendor->nama }}
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-no-wrap text-sm font-medium text-gray-700 dark:text-gray-300">
                            Tanggal Pembelian
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap text-sm text-gray-900 dark:text-gray-100">
                            {{ $pembelian->tgl_pembelian }}
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-no-wrap text-sm font-medium text-gray-700 dark:text-gray-300">
                            Status
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap text-sm text-gray-900 dark:text-gray-100">
                            {{ $pembelian->status->nama_status }}
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-no-wrap text-sm font-medium text-gray-700 dark:text-gray-300">
                            Pengirim
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap text-sm text-gray-900 dark:text-gray-100">
                            {{ $pembelian->pengirim->jenis ?? 'N/A' }}
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-no-wrap text-sm font-medium text-gray-700 dark:text-gray-300">
                            Tanggal Pengiriman
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap text-sm text-gray-900 dark:text-gray-100">
                            {{ $pembelian->tgl_pengiriman ?? 'N/A' }}
                        </td>
                    </tr>
                </tbody>
            </table>

            <table class="min-w-full divide-y divide-gray-200 mt-6">
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
                                {{ 'Rp' . number_format($item->harga, 0, ',', '.') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-6 flex justify-end">
                <a href="{{ route('pembelian.edit', $pembelian->id) }}" class="btn btn-light border-custom mr-2">Edit</a>
                <a href="{{ route('pembelian.index') }}" class="btn btn-light border-custom">Kembali</a>
            </div>
        </div>
    </div>
</x-app-layout>
