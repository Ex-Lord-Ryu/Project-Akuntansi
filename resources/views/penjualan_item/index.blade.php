<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Penjualan Item') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center mt-6">
            <h1 class="text-2xl font-bold">Daftar Penjualan Item</h1>
            <a href="{{ route('penjualan_item.create') }}" class="btn btn-primary">Tambah Penjualan Item</a>
        </div>

        <div class="mt-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
            <table class="table-auto w-full">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="px-4 py-2">ID</th>
                        <th class="px-4 py-2">ID Penjualan</th>
                        <th class="px-4 py-2">Barang</th>
                        <th class="px-4 py-2">Qty</th>
                        <th class="px-4 py-2">Harga</th>
                        <th class="px-4 py-2">PPN</th>
                        <th class="px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800">
                    @foreach ($penjualan_items as $item)
                        <tr class="border-t">
                            <td class="px-4 py-2 text-center">{{ $item->id }}</td>
                            <td class="px-4 py-2 text-center">{{ $item->penjualan_id }}</td>
                            <td class="px-4 py-2 text-center">{{ $item->barang ? $item->barang->nama : 'N/A' }}</td>
                            <td class="px-4 py-2 text-center">{{ $item->qty }}</td>
                            <td class="px-4 py-2 text-center">{{ $item->harga }}</td>
                            <td class="px-4 py-2 text-center">{{ $item->ppn }}</td>
                            <td class="px-4 py-2 text-center">
                                <a href="{{ route('penjualan_item.show', $item->id) }}" class="btn btn-info">Lihat</a>
                                <a href="{{ route('penjualan_item.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('penjualan_item.destroy', $item->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-4 mb-4">
                {{ $penjualan_items->links() }}
            </div>
        </div>
    </div>
</x-app-layout>