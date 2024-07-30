<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detail Stok') }}
        </h2>
    </x-slot>

    <link rel="stylesheet" href="{{ asset('assets/css/btn.css') }}">

    <div class="container mx-auto px-4">
        <div class="mt-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
            <div class="mb-4">
                <h3 class="text-lg font-semibold">Detail Stok</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200">
                        <tr>
                            <td class="px-6 py-4 whitespace-no-wrap text-sm font-medium text-gray-700 dark:text-gray-300">
                                Nama Barang
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap text-sm text-gray-900 dark:text-gray-100">
                                {{ $stok->barang->nama }}
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-no-wrap text-sm font-medium text-gray-700 dark:text-gray-300">
                                Warna
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap text-sm text-gray-900 dark:text-gray-100">
                                {{ $stok->warna->warna ?? 'N/A' }}
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-no-wrap text-sm font-medium text-gray-700 dark:text-gray-300">
                                No Rangka
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap text-sm text-gray-900 dark:text-gray-100">
                                {{ $stok->no_rangka }}
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-no-wrap text-sm font-medium text-gray-700 dark:text-gray-300">
                                No Mesin
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap text-sm text-gray-900 dark:text-gray-100">
                                {{ $stok->no_mesin }}
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-no-wrap text-sm font-medium text-gray-700 dark:text-gray-300">
                                Harga
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap text-sm text-gray-900 dark:text-gray-100">
                                {{ 'Rp' . number_format($stok->harga, 0, ',', '.') }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="flex justify-end mt-4">
                <a href="{{ route('stok.edit', $stok->id) }}" class="btn btn-light border-custom mr-2">Edit</a>
                <a href="{{ route('stok.index') }}" class="btn btn-light border-custom">Kembali</a>
            </div>
        </div>
    </div>
</x-app-layout>
