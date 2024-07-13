<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Pembelian Item') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4">
        <div class="mt-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
            <form action="{{ route('pembelian_item.update', [$pembelian_item->id_pembelian, $pembelian_item->id_barang]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="id_pembelian" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Pembelian</label>
                    <select name="id_pembelian" id="id_pembelian" class="form-control mt-1 block w-full" required>
                        @foreach ($pembelians as $pembelian)
                            <option value="{{ $pembelian->id }}" {{ $pembelian->id == $pembelian_item->id_pembelian ? 'selected' : '' }}>{{ $pembelian->id }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="id_barang" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Barang</label>
                    <select name="id_barang" id="id_barang" class="form-control mt-1 block w-full" required>
                        @foreach ($barangs as $barang)
                            <option value="{{ $barang->id }}" {{ $barang->id == $pembelian_item->id_barang ? 'selected' : '' }}>{{ $barang->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="qty" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Qty</label>
                    <input type="number" name="qty" id="qty" class="form-control mt-1 block w-full" value="{{ $pembelian_item->qty }}" required>
                </div>
                <div class="mb-4">
                    <label for="harga" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Harga</label>
                    <input type="number" name="harga" id="harga" class="form-control mt-1 block w-full" value="{{ $pembelian_item->harga }}" required>
                </div>
                <div class="mb-4">
                    <label for="ppn" class="block text-sm font-medium text-gray-700 dark:text-gray-300">PPN</label>
                    <input type="number" name="ppn" id="ppn" class="form-control mt-1 block w-full" value="{{ $pembelian_item->ppn }}" required>
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="btn btn-success">Update</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
