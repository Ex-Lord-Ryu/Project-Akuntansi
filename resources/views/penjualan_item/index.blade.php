<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Penjualan Item') }}
        </h2>
    </x-slot>

    <link rel="stylesheet" href="{{ asset('assets/css/btn.css') }}">

    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center mt-6">
            <h1 class="text-2xl font-bold">Daftar Penjualan Item</h1>
            {{-- <a href="{{ route('penjualan_item.create') }}" class="btn btn-light border-custom">Tambah Penjualan Item</a> --}}
        </div>
        <div class="flex justify-end mt-4">
            <a href="{{ route('penjualan.index') }}" class="btn btn-light border-custom">Daftar Penjualan</a>
        </div>

        <div class="mt-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
            <table class="table-auto w-full">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="px-4 py-2">ID</th>
                        <th class="px-4 py-2">ID Penjualan</th>
                        <th class="px-4 py-2">Barang</th>
                        <th class="px-4 py-2">Stok</th>
                        <th class="px-4 py-2">Warna</th>
                        <th class="px-4 py-2">No Rangka</th>
                        <th class="px-4 py-2">No Mesin</th>
                        <th class="px-4 py-2">Harga</th>
                        <th class="px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800">
                    @foreach ($penjualan_items as $item)
                        <tr class="border-t">
                            <td class="px-4 py-2 text-center">{{ $item->id }}</td>
                            <td class="px-4 py-2 text-center">{{ $item->id_penjualan }}</td>
                            <td class="px-4 py-2 text-center">{{ $item->barang ? $item->barang->nama : 'N/A' }}</td>
                            <td class="px-4 py-2 text-center">{{ $item->stok ? $item->stok->nama : 'N/A' }}</td>
                            <td class="px-4 py-2 text-center">{{ $item->warna ? $item->warna->nama : 'N/A' }}</td>
                            <td class="px-4 py-2 text-center">{{ $item->no_rangka }}</td>
                            <td class="px-4 py-2 text-center">{{ $item->no_mesin }}</td>
                            <td class="px-4 py-2 text-center">{{ $item->harga }}</td>
                            <td class="px-4 py-2 text-center">
                                {{-- <a href="{{ route('penjualan_item.show', ['penjualan_item' => $item]) }}"
                                    class="btn btn-dark btn-action mb-2">Lihat</a> --}}
                                {{-- <a href="{{ route('penjualan_item.edit', ['penjualan_item' => $item]) }}"
                                    class="btn btn-dark btn-action mb-2">Edit</a> --}}
                                <form action="{{ route('penjualan_item.destroy', ['penjualan_item' => $item]) }}"
                                    method="POST" class="mb-2" onsubmit="return confirmDelete()">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-light btn-action">Hapus</button>
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

<script>
    function confirmDelete() {
        return confirm('Data yang dihapus tidak dapat direstorasi?');
    }
</script>
