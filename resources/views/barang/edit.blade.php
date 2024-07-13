<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Barang') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4">
        <div class="mt-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
            <form action="{{ route('barang.update', $barang->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="nama" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Barang</label>
                    <input type="text" name="nama" id="nama" class="form-control mt-1 block w-full" value="{{ $barang->nama }}" required>
                </div>
                <div class="mb-4">
                    <label for="stok" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Stok</label>
                    <input type="number" name="stok" id="stok" class="form-control mt-1 block w-full" value="{{ $barang->stok }}" required>
                </div>
                <div class="mb-4">
                    <label for="harga" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Harga</label>
                    <input type="number" name="harga" id="harga" class="form-control mt-1 block w-full" value="{{ $barang->harga }}" required>
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="btn btn-success">Update</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
