<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Warna') }}
        </h2>
    </x-slot>

    <link rel="stylesheet" href="{{ asset('assets/css/btn.css') }}">

    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center mt-6">
            <h1 class="text-2xl font-bold">Daftar Warna</h1>
            <a href="{{ route('warna.create') }}" class="btn btn-light border-custom">Tambah Warna</a>
        </div>
        <div class="flex justify-end mt-4">
            <a href="{{ route('stok.index') }}" class="btn btn-light border-custom mr-2">Daftar stok</a>
            <a href="{{ route('stok_terjual.index') }}" class="btn btn-light border-custom mr-2">Daftar stok Terjual</a>
        </div>

        <div class="mt-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
            <table class="table-auto w-full">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="px-4 py-2 text-center">ID</th>
                        <th class="px-4 py-2 text-center">Warna</th>
                        <th class="px-4 py-2 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800">
                    @foreach ($warna as $item)
                        <tr class="border-t">
                            <td class="px-4 py-2 text-center">{{ $item->id }}</td>
                            <td class="px-4 py-2 text-center">{{ $item->warna }}</td>
                            <td class="px-4 py-2 text-center">
                                <div class="flex justify-center items-center space-x-2">
                                    {{-- <a href="{{ route('warna.show', $item->id) }}" class="btn btn-dark btn-action">Lihat</a> --}}
                                    <a href="{{ route('warna.edit', $item->id) }}" class="btn btn-dark btn-action">Edit</a>
                                    <form action="{{ route('warna.destroy', $item->id) }}" method="POST" onclick="return confirmDelete()">
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
