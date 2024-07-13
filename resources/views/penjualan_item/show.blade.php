<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detail Penjualan Item') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="mb-4">
                    <h3 class="text-lg font-medium text-gray-700 dark:text-gray-300">ID Penjualan: {{ $penjualan_item->id_penjualan }}</h3>
                </div>
                <div class="mb-4">
                    <h3 class="text-lg font-medium text-gray-700 dark:text-gray-300">Barang: {{ $penjualan_item->barang->nama }}</h3>
                </div>
                <div class="mb-4">
                    <h3 class="text-lg font-medium text-gray-700 dark:text-gray-300">Qty: {{ $penjualan_item->qty }}</h3>
                </div>
                <div class="mb-4">
                    <h3 class="text-lg font-medium text-gray-700 dark:text-gray-300">Harga: {{ $penjualan_item->harga }}</h3>
                </div>
                <div class="mb-4">
                    <h3 class="text-lg font-medium text-gray-700 dark:text-gray-300">PPN: {{ $penjualan_item->ppn }}</h3>
                </div>
                <div class="flex items-center justify-end mt-4">
                    <a href="{{ route('penjualan_item.edit', $penjualan_item->id) }}" class="btn btn-warning mr-2">Edit</a>
                    <form action="{{ route('penjualan_item.destroy', $penjualan_item->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
