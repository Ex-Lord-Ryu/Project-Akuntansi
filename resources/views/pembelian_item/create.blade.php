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
                    <label for="qty" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Qty</label>
                    <input type="number" name="qty" id="qty" class="form-control mt-1 block w-full @error('qty') is-invalid @enderror" required>
                    @error('qty')
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
                <div class="mb-4">
                    <label for="ppn" class="block text-sm font-medium text-gray-700 dark:text-gray-300">PPN</label>
                    <input type="number" name="ppn" id="ppn" class="form-control mt-1 block w-full @error('ppn') is-invalid @enderror" value="10" required>
                    @error('ppn')
                        <div class="alert alert-danger mt-2 text-red-600">{{ $message }}</div>
                    @enderror
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
