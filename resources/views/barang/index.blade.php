<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Barang') }}
        </h2>
    </x-slot>

    <link rel="stylesheet" href="{{ asset('assets/css/btn.css') }}">

    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center mt-6">
            <h1 class="text-2xl font-bold">Daftar Barang</h1>
            <a href="{{ route('barang.create') }}" class="btn btn-light border-custom">Tambah Barang</a>
        </div>

        <div class="mt-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
            <table class="table-auto w-full">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="px-4 py-2 text-center">ID</th>
                        <th class="px-4 py-2 text-center">Nama</th>
                        <th class="px-4 py-2 text-center">Stok</th>
                        <th class="px-4 py-2 text-center">Tanggal Pengiriman</th>
                        <th class="px-4 py-2 text-center">Tanggal Penjualan</th> <!-- New column for Tanggal Penjualan -->
                        <th class="px-4 py-2 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800">
                    @foreach ($barang as $item)
                        <tr class="border-t text-center">
                            <td class="px-4 py-2 ">{{ $item->id }}</td>
                            <td class="px-4 py-2 ">{{ $item->nama }}</td>
                            <td class="px-4 py-2 ">{{ $item->stok }}</td>
                            <td class="px-4 py-2 ">{{ $item->tgl_pengiriman ?? 'N/A' }}</td>
                            <td class="px-4 py-2 ">{{ $item->tgl_penjualan ?? 'N/A' }}</td> <!-- Display Tanggal Penjualan -->
                            <td class="px-4 py-2 ">
                                {{-- <a href="{{ route('barang.show', $item->id) }}" class="btn btn-info">Lihat</a> --}}
                                <a href="{{ route('barang.edit', $item->id) }}" class="btn btn-dark btn-action">Edit</a>
                                <form action="{{ route('barang.destroy', $item->id) }}" method="POST"
                                    onclick="return ConfirmDelete()">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-light btn-action">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>

<script>
    function ConfirmDelete() {
        return confirm('Data yang dihapus tidak dapat direstorasi?');
    }
</script>
