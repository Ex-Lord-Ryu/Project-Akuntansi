<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        <!-- Barang -->
                        <div class="text-center">
                            <p class="mb-2 font-semibold">Barang</p>
                            <a href="{{ route('barang.index') }}" class="btn btn-primary">
                                Go to Barang
                            </a>
                        </div>
                        
                        <!-- Pelanggan -->
                        <div class="text-center">
                            <p class="mb-2 font-semibold">Pelanggan</p>
                            <a href="{{ route('pelanggan.index') }}" class="btn btn-primary">
                                Go to Pelanggan
                            </a>
                        </div>
                        
                        <!-- Pembelian -->
                        <div class="text-center">
                            <p class="mb-2 font-semibold">Pembelian</p>
                            <a href="{{ route('pembelian.index') }}" class="btn btn-primary">
                                Go to Pembelian
                            </a>
                        </div>
                        
                        <!-- Pembelian Item -->
                        <div class="text-center">
                            <p class="mb-2 font-semibold">Pembelian Item</p>
                            <a href="{{ route('pembelian_item.index') }}" class="btn btn-primary">
                                Go to Pembelian Item
                            </a>
                        </div>
                        
                        <!-- Pengirim -->
                        <div class="text-center">
                            <p class="mb-2 font-semibold">Pengirim</p>
                            <a href="{{ route('pengirim.index') }}" class="btn btn-primary">
                                Go to Pengirim
                            </a>
                        </div>
                        
                        <!-- Penjualan -->
                        <div class="text-center">
                            <p class="mb-2 font-semibold">Penjualan</p>
                            <a href="{{ route('penjualan.index') }}" class="btn btn-primary">
                                Go to Penjualan
                            </a>
                        </div>
                        
                        <!-- Penjualan Item -->
                        <div class="text-center">
                            <p class="mb-2 font-semibold">Penjualan Item</p>
                            <a href="{{ route('penjualan_item.index') }}" class="btn btn-primary">
                                Go to Penjualan Item
                            </a>
                        </div>
                        
                        <!-- Status -->
                        <div class="text-center">
                            <p class="mb-2 font-semibold">Status</p>
                            <a href="{{ route('status.index') }}" class="btn btn-primary">
                                Go to Status
                            </a>
                        </div>
                        
                        <!-- Vendor -->
                        <div class="text-center">
                            <p class="mb-2 font-semibold">Vendor</p>
                            <a href="{{ route('vendor.index') }}" class="btn btn-primary">
                                Go to Vendor
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
