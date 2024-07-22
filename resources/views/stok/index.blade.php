<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Stok') }}
        </h2>
    </x-slot>

    <link rel="stylesheet" href="{{ asset('assets/css/btn.css') }}">

    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center mt-6">
            <h1 class="text-2xl font-bold">Daftar Stok</h1>
            {{-- <a href="{{ route('stok.create') }}" class="btn btn-light">Tambah Stok</a> --}}
        </div>
        <div class="flex justify-end mt-4">
            <a href="{{ route('pembelian.index') }}" class="btn btn-light border-custom mr-2">Daftar Pembelian</a>
            <a href="{{ route('pembelian_item.index') }}" class="btn btn-light border-custom mr-2">Daftar Pembelian
                Item</a>
            <a href="{{ route('barang.index') }}" class="btn btn-light border-custom mr-2">Daftar Barang</a>
        </div>

        <div class="mt-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <table class="table-auto w-full">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr class="text-center">
                        <th class="px-4 py-2">ID</th>
                        {{-- <th class="px-4 py-2">ID PMB</th>
                        <th class="px-4 py-2">ID PMB Item</th> --}}
                        <th class="px-4 py-2">Nama Barang</th>
                        <th class="px-4 py-2">Warna</th>
                        <th class="px-4 py-2">No Rangka</th>
                        <th class="px-4 py-2">No Mesin</th>
                        <th class="px-4 py-2">TGL_PNM</th>
                        <th class="px-4 py-2">Update Barang</th>
                        <th class="px-4 py-2">Harga</th>
                        <th class="px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800">
                    @foreach ($stok as $item)
                        <tr class="border-t text-center">
                            <td class="px-4 py-2">{{ $item->id }}</td>
                            {{-- <td class="px-4 py-2">{{ $item->id_pembelian }}</td>
                            <td class="px-4 py-2">{{ $item->id_pembelian_item }}</td> --}}
                            <td class="px-4 py-2">{{ $item->barang->nama }}</td>
                            <td class="px-4 py-2">{{ $item->warna->warna ?? 'N/A' }}</td>
                            <td class="px-4 py-2">{{ $item->no_rangka }}</td>
                            <td class="px-4 py-2">{{ $item->no_mesin }}</td>
                            <td class="px-4 py-2">{{ $item->tgl_penerimaan }}</td>
                            <td class="px-4 py-2">{{ $item->status}}</td>
                            <td class="px-4 py-2">{{ $item->harga }}</td>
                            <td class="px-4 py-2">
                                <div class="flex flex-col items-center">
                                    <a href="{{ route('stok.show', $item->id) }}"
                                        class="btn btn-dark mb-2 btn-action">Lihat</a>
                                    <a href="{{ route('stok.edit', $item->id) }}"
                                        class="btn btn-dark mb-2 btn-action">Edit</a>
                                    <form action="{{ route('stok.destroy', $item->id) }}" method="POST" class="mb-2"
                                        onclick="return confirmDelete()">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-light btn-action">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-4 mb-4">
                {{ $stok->links() }}
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    function confirmDelete() {
        return confirm('Data yang dihapus tidak dapat direstorasi?');
    }
</script>
