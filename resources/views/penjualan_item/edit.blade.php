<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Penjualan Item') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('penjualan_item.update', $penjualan_item->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- ID Penjualan -->
                    <div class="mb-4">
                        <label for="id_penjualan" class="block text-sm font-medium text-gray-700 dark:text-gray-300">ID Penjualan</label>
                        <select name="id_penjualan" id="id_penjualan" class="form-select mt-1 block w-full">
                            @foreach ($penjualans as $penjualan)
                                <option value="{{ $penjualan->id }}" {{ $penjualan->id == $penjualan_item->id_penjualan ? 'selected' : '' }}>{{ $penjualan->id }}</option>
                            @endforeach
                        </select>
                        @error('id_penjualan')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Barang -->
                    <div class="mb-4">
                        <label
                        <!-- Barang -->
                        <div class="mb-4">
                            <label for="id_barang" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Barang</label>
                            <select name="id_barang" id="id_barang" class="form-select mt-1 block w-full">
                                @foreach ($barangs as $barang)
                                    <option value="{{ $barang->id }}" {{ $barang->id == $penjualan_item->id_barang ? 'selected' : '' }}>{{ $barang->nama }}</option>
                                @endforeach
                            </select>
                            @error('id_barang')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
    
                        <!-- Qty -->
                        <div class="mb-4">
                            <label for="qty" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Qty</label>
                            <input type="number" name="qty" id="qty" class="form-input mt-1 block w-full" value="{{ $penjualan_item->qty }}" required>
                            @error('qty')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
    
                        <!-- Harga -->
                        <div class="mb-4">
                            <label for="harga" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Harga</label>
                            <input type="number" name="harga" id="harga" class="form-input mt-1 block w-full" value="{{ $penjualan_item->harga }}" required>
                            @error('harga')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
    
                        <!-- PPN -->
                        <div class="mb-4">
                            <label for="ppn" class="block text-sm font-medium text-gray-700 dark:text-gray-300">PPN</label>
                            <input type="number" name="ppn" id="ppn" class="form-input mt-1 block w-full" value="{{ $penjualan_item->ppn }}" required>
                            @error('ppn')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
    
                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </x-app-layout>
    