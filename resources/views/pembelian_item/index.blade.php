<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Pembelian Item') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4">
        <div class="mt-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
            <div class="flex justify-between items-center mt-6">
                <h1 class="text-2xl font-bold">Daftar Pembelian Item</h1>
                <a href="{{ route('pembelian_item.create') }}" class="btn btn-primary">Tambah Pembelian Item</a>
            </div>

            <div class="mt-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <table class="table-auto w-full text-center">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-4 py-2">ID</th>
                            <th class="px-4 py-2">ID Pembelian</th>
                            <th class="px-4 py-2">Barang</th>
                            <th class="px-4 py-2">Qty</th>
                            <th class="px-4 py-2">Harga</th>
                            <th class="px-4 py-2">PPN</th>
                            <th class="px-4 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 text-center">
                        @foreach ($pembelian_items as $item)
                            <tr class="border-t">
                                <td class="px-4 py-2">{{ $item->id }}</td>
                                <td class="px-4 py-2">{{ $item->id_pembelian }}</td>
                                <td class="px-4 py-2">{{ $item->barang->nama }}</td>
                                <td class="px-4 py-2">{{ $item->qty }}</td>
                                <td class="px-4 py-2">{{ $item->harga }}</td>
                                <td class="px-4 py-2">{{ $item->ppn }}</td>
                                <td class="px-4 py-2">
                                    <a href="{{ route('pembelian_item.show', ['pembelian_item' => $item->id]) }}" class="btn btn-info">Lihat</a>
                                    <a href="{{ route('pembelian_item.edit', ['pembelian_item' => $item->id]) }}" class="btn btn-warning">Edit</a>
                                    <form action="{{ route('pembelian_item.destroy', ['pembelian_item' => $item->id]) }}" method="POST" style="display:inline-block;">
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
                    {{ $pembelian_items->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
