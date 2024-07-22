<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Status') }}
        </h2>
    </x-slot>

    <link rel="stylesheet" href="{{ asset('assets/css/btn.css') }}">

    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center mt-6">
            <h1 class="text-2xl font-bold">Daftar Status</h1>
            <a href="{{ route('status.create') }}" class="btn btn-light border-custom">Tambah Status</a>
        </div>
        <div class="flex justify-end mt-4">
            <a href="{{ route('pembelian.index') }}" class="btn btn-light border-custom mr-2">Daftar Pembelian</a>
            <a href="{{ route('pembelian_item.index') }}" class="btn btn-light border-custom mr-2">Daftar Pembelian Item</a>
            <a href="{{ route('penjualan.index') }}" class="btn btn-light border-custom mr-2">Daftar Penjualan</a>
            <a href="{{ route('penjualan_item.index') }}" class="btn btn-light border-custom mr-2">Daftar Penjualan Item</a>
        </div>

        <div class="mt-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <table class="table-auto w-full">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr class="text-center">
                        <th class="px-4 py-2">ID</th>
                        <th class="px-4 py-2">Nama Status</th>
                        <th class="px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800">
                    @foreach ($statuses as $item)
                        <tr class="border-t text-center">
                            <td class="px-4 py-2">{{ $item->id }}</td>
                            <td class="px-4 py-2">{{ $item->nama_status }}</td>
                            <td class="px-4 py-2">
                                <div class="flex justify-center items-center space-x-2">
                                    <a href="{{ route('status.show', $item->id) }}" class="btn btn-dark btn-action">Lihat</a>
                                    <a href="{{ route('status.edit', $item->id) }}" class="btn btn-dark btn-action">Edit</a>
                                    <form action="{{ route('status.destroy', $item->id) }}" method="POST" 
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
        </div>
    </div>
</x-app-layout>

<script>
    function confirmDelete() {
        return confirm('Data yang dihapus tidak dapat direstorasi?');
    }
</script>

