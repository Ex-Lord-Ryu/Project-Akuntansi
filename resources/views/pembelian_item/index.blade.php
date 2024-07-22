<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Pembelian Items') }}
        </h2>
    </x-slot>

    <link rel="stylesheet" href="{{ asset('assets/css/btn.css') }}">

    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center mt-6">
            <h1 class="text-2xl font-bold">Daftar Pembelian Items</h1>
            {{-- <a href="{{ route('pembelian_item.create') }}" class="btn btn-light border-custom">Tambah Pembelian Item</a> --}}
        </div>
        <div class="flex justify-end mt-4">
            <a href="{{ route('pembelian.index') }}" class="btn btn-light border-custom">Daftar Pembelian</a>
        </div>
        
        <div class="mt-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
            <table class="table-auto w-full">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr class="text-center">
                        <th class="px-4 py-2">ID Pembelian</th>
                        <th class="px-4 py-2">Barang</th>
                        <th class="px-4 py-2">Warna</th>
                        <th class="px-4 py-2">Harga</th>
                        <th class="px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800">
                    @foreach ($pembelianItems as $item)
                        <tr class="border-t text-center">
                            <td class="px-4 py-2">{{ $item->id_pembelian }}</td>
                            <td class="px-4 py-2">{{ $item->barang->nama }}</td>
                            <td class="px-4 py-2">{{ $item->warna->warna ?? 'N/A' }}</td>
                            <td class="px-4 py-2">{{ $item->harga }}</td>
                            <td class="px-4 py-2">
                                <div class="flex justify-center items-center space-x-2">
                                    {{-- <a href="{{ route('pembelian_item.show', $item->id) }}" class="btn btn-dark btn-action">Lihat</a> --}}
                                    {{-- <a href="{{ route('pembelian_item.edit', $item->id) }}" class="btn btn-dark btn-action">Edit</a> --}}
                                    <form action="{{ route('pembelian_item.destroy', $item->id) }}" method="POST" 
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
            <div class="mt-4">
                {{ $pembelianItems->links() }}
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    function confirmDelete() {
        return confirm('Data yang dihapus tidak dapat direstorasi?');
    }
</script>
