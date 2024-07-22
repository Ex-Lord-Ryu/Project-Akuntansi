<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Pelanggan') }}
        </h2>
    </x-slot>

    <link rel="stylesheet" href="{{ asset('assets/css/btn.css') }}">

    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center mt-6">
            <h1 class="text-2xl font-bold">Daftar Pelanggan</h1>
            <a href="{{ route('pelanggan.create') }}" class="btn btn-light border-custom">Tambah Pelanggan</a>
        </div>
        <div class="flex justify-end mt-4">
            <a href="{{ route('penjualan.index') }}" class="btn btn-light border-custom mr-2">Daftar Penjualan</a>
        </div>

        <div class="mt-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="w-full overflow-auto"> <!-- Added wrapper to enable horizontal scrolling -->
                <table class="table-auto w-full">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-4 py-2">ID</th>
                            <th class="px-4 py-2">Nama</th>
                            <th class="px-4 py-2">Tanggal Lahir</th>
                            <th class="px-4 py-2">No HP</th>
                            <th class="px-4 py-2">Email</th>
                            <th class="px-4 py-2">Alamat</th>
                            <th class="px-4 py-2">Wilayah</th>
                            <th class="px-4 py-2">Provinsi</th>
                            <th class="px-4 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800">
                        @foreach ($pelanggan as $item)
                            <tr class="border-t">
                                <td class="px-4 py-2 text-center whitespace-nowrap overflow-hidden text-ellipsis"
                                    style="max-width: 50px;">{{ $item->id }}</td>
                                <td class="px-4 py-2 text-center whitespace-nowrap overflow-hidden text-ellipsis"
                                    style="max-width: 150px;">{{ $item->nama }}</td>
                                <td class="px-4 py-2 text-center whitespace-nowrap overflow-hidden text-ellipsis"
                                    style="max-width: 100px;">{{ $item->tgl_lahir }}</td>
                                <td class="px-4 py-2 text-center whitespace-nowrap overflow-hidden text-ellipsis"
                                    style="max-width: 100px;">{{ $item->no_hp }}</td>
                                <td class="px-4 py-2 text-center whitespace-nowrap overflow-hidden text-ellipsis"
                                    style="max-width: 200px;">{{ $item->email }}</td>
                                <td class="px-4 py-2 text-center whitespace-nowrap overflow-hidden text-ellipsis"
                                    style="max-width: 200px;">{{ $item->alamat }}</td>
                                <td class="px-4 py-2 text-center whitespace-nowrap overflow-hidden text-ellipsis"
                                    style="max-width: 150px;">{{ $item->wilayah }}</td>
                                <td class="px-4 py-2 text-center whitespace-nowrap overflow-hidden text-ellipsis"
                                    style="max-width: 150px;">{{ $item->provinsi }}</td>
                                <td class="px-4 py-2 text-center">
                                    <div class="flex flex-col items-center">
                                        <a href="{{ route('pelanggan.show', $item->id) }}"
                                            class="btn btn-dark mb-2 btn-action">Lihat</a>
                                        <a href="{{ route('pelanggan.edit', $item->id) }}"
                                            class="btn btn-dark mb-2 btn-action">Edit</a>
                                        <form action="{{ route('pelanggan.destroy', $item->id) }}" method="POST"
                                            class="MB-2" onclick="return confirmDelete()">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-Light btn-action">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $pelanggan->links() }} <!-- Add pagination links here -->
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    function confirmDelete() {
        return confirm('Data yang dihapus tidak dapat direstorasi?');
    }
</script>
