<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Barang') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center mt-6">
            <h1 class="text-2xl font-bold">Daftar Barang</h1>
            <a href="{{ route('barang.create') }}" class="btn btn-primary">Tambah Barang</a>
        </div>

        <div class="mt-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
            <table class="table-auto w-full">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="px-4 py-2 text-center">ID</th>
                        <th class="px-4 py-2 text-center">Nama</th>
                        <th class="px-4 py-2 text-center">Stok</th>
                        <th class="px-4 py-2 text-center">Tanggal Pengiriman</th>
                        <th class="px-4 py-2 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800">
                    @foreach ($barang as $item)
                        <tr class="border-t">
                            <td class="px-4 py-2 text-center">{{ $item->id }}</td>
                            <td class="px-4 py-2 text-center">{{ $item->nama }}</td>
                            <td class="px-4 py-2 text-center">{{ $item->stok }}</td>
                            <td class="px-4 py-2 text-center">{{ $item->tgl_pengiriman ?? 'N/A' }}</td>
                            <td class="px-4 py-2 text-center">
                                <a href="{{ route('barang.show', $item->id) }}" class="btn btn-info">Lihat</a>
                                <a href="{{ route('barang.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('barang.destroy', $item->id) }}" method="POST"
                                    style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
