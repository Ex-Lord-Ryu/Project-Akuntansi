<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detail Barang') }}
        </h2>
    </x-slot>

    <link rel="stylesheet" href="{{ asset('assets/css/btn.css') }}">

    <div class="container mx-auto px-4">
        <div class="mt-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th colspan="2" class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Informasi Vendor
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200">
                    <tr>
                        <td class="px-6 py-4 whitespace-no-wrap text-sm font-medium text-gray-700 dark:text-gray-300">
                            Nama
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap text-sm text-gray-900 dark:text-gray-100">
                            {{ $barang->nama }}
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-no-wrap text-sm font-medium text-gray-700 dark:text-gray-300">
                            Stok
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap text-sm text-gray-900 dark:text-gray-100">
                            {{ $barang->stok }}
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-no-wrap text-sm font-medium text-gray-700 dark:text-gray-300">
                            Harga
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap text-sm text-gray-900 dark:text-gray-100">
                            {{ $barang->harga }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="mt-6 flex justify-end">
                <a href="{{ route('barnag.index') }}" class="btn btn-light border-custom" >Kembali</a>
            </div>
        </div>
    </div>
</x-app-layout>
