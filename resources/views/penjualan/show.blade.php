<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detail Penjualan') }}
        </h2>
    </x-slot>

    <link rel="stylesheet" href="{{ asset('assets/css/btn.css') }}">

    <div class="container mx-auto px-4 py-6">
        <div class="mt-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th colspan="2" class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Informasi Penjualan
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200">
                    <tr>
                        <td class="px-6 py-4 whitespace-no-wrap text-sm font-medium text-gray-700 dark:text-gray-300">
                            Pelanggan
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap text-sm text-gray-900 dark:text-gray-100">
                            {{ $penjualan->pelanggan->nama }}
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-no-wrap text-sm font-medium text-gray-700 dark:text-gray-300">
                            Tanggal Penjualan
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap text-sm text-gray-900 dark:text-gray-100">
                            {{ $penjualan->tgl_penjualan }}
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-no-wrap text-sm font-medium text-gray-700 dark:text-gray-300">
                            Status
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap text-sm text-gray-900 dark:text-gray-100">
                            {{ $penjualan->status->nama_status }}
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-no-wrap text-sm font-medium text-gray-700 dark:text-gray-300">
                            Pengirim
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap text-sm text-gray-900 dark:text-gray-100">
                            {{ $penjualan->pengirim->jenis ?? 'N/A' }}
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-no-wrap text-sm font-medium text-gray-700 dark:text-gray-300">
                            Tanggal Pengiriman
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap text-sm text-gray-900 dark:text-gray-100">
                            {{ $penjualan->tgl_penerimaan ?? 'N/A' }}
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
                            No Rangka
                        </th>
                        <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            No Mesin
                        </th>
                        <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Harga
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200">
                    @foreach ($penjualan->penjualanItems as $item)
                        <tr>
                            <td class="px-6 py-4 whitespace-no-wrap text-sm font-medium text-gray-900 dark:text-gray-100">
                                {{ $item->barang->nama ?? 'N/A' }}
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap text-sm text-gray-500 dark:text-gray-300">
                                {{ $item->warna->warna ?? 'N/A' }}
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap text-sm text-gray-500 dark:text-gray-300">
                                {{ $item->no_rangka }}
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap text-sm text-gray-500 dark:text-gray-300">
                                {{ $item->no_mesin }}
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap text-sm text-gray-500 dark:text-gray-300">
                                {{ 'Rp' . number_format($item->harga, 0, ',', '.') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-6 flex justify-end">
                <a href="{{ route('penjualan.edit', $penjualan->id) }}" class="btn btn-light border-custom mr-2">Edit</a>
                <a href="{{ route('penjualan.index') }}" class="btn btn-light border-custom">Kembali</a>
            </div>
        </div>
    </div>
</x-app-layout>
