<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Pembelian Item') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4">
        <div class="mt-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
            <form action="{{ route('pembelian_item.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="id_pembelian" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Pembelian</label>
                    <select name="id_pembelian" id="id_pembelian" class="form-control mt-1 block w-full @error('id_pembelian') is-invalid @enderror" required>
                        @foreach ($pembelians as $pembelian)
                            <option value="{{ $pembelian->id }}">{{ $pembelian->id }}</option>
                        @endforeach
                    </select>
                    @error('id_pembelian')
                        <div class="alert alert-danger mt-2 text-red-600">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="id_barang" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Barang</label>
                    <select name="id_barang" id="id_barang" class="form-control mt-1 block w-full @error('id_barang') is-invalid @enderror" required>
                        @foreach ($barangs as $barang)
                            <option value="{{ $barang->id }}">{{ $barang->nama }}</option>
                        @endforeach
                    </select>
                    @error('id_barang')
                        <div class="alert alert-danger mt-2 text-red-600">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="id_warna" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Warna</label>
                    <select name="id_warna" id="id_warna" class="form-control mt-1 block w-full @error('id_warna') is-invalid @enderror">
                        @foreach ($warnas as $warna)
                            <option value="{{ $warna->id }}">{{ $warna->warna }}</option>
                        @endforeach
                    </select>
                    @error('id_warna')
                        <div class="alert alert-danger mt-2 text-red-600">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="no_rangka" class="block text-sm font-medium text-gray-700 dark:text-gray-300">No Rangka</label>
                    <input type="text" name="no_rangka" id="no_rangka" class="form-control mt-1 block w-full @error('no_rangka') is-invalid @enderror">
                    @error('no_rangka')
                        <div class="alert alert-danger mt-2 text-red-600">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="no_mesin" class="block text-sm font-medium text-gray-700 dark:text-gray-300">No Mesin</label>
                    <input type="text" name="no_mesin" id="no_mesin" class="form-control mt-1 block w-full @error('no_mesin') is-invalid @enderror">
                    @error('no_mesin')
                        <div class="alert alert-danger mt-2 text-red-600">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="harga" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Harga</label>
                    <input type="number" name="harga" id="harga" class="form-control mt-1 block w-full @error('harga') is-invalid @enderror" required>
                    @error('harga')
                        <div class="alert alert-danger mt-2 text-red-600">{{ $message }}</div>
                    @enderror
                </div>
                <div class="flex justify-between items-center">
                    <a href="{{ route('pembelian_item.index') }}" class="btn btn-dark">Back</a>
                    <div class="flex space-x-2">
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
