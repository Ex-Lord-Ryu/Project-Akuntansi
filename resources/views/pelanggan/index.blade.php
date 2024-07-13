<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Pelanggan') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center mt-6">
            <h1 class="text-2xl font-bold">Daftar Pelanggan</h1>
            <a href="{{ route('pelanggan.create') }}" class="btn btn-primary">Tambah Pelanggan</a>
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
                                <td class="px-4 py-2 text-center whitespace-nowrap overflow-hidden text-ellipsis">{{ $item->id }}</td>
                                <td class="px-4 py-2 text-center whitespace-nowrap overflow-hidden text-ellipsis">{{ $item->nama }}</td>
                                <td class="px-4 py-2 text-center whitespace-nowrap overflow-hidden text-ellipsis">{{ $item->tgl_lahir }}</td>
                                <td class="px-4 py-2 text-center whitespace-nowrap overflow-hidden text-ellipsis">{{ $item->no_hp }}</td>
                                <td class="px-4 py-2 text-center whitespace-nowrap overflow-hidden text-ellipsis">{{ $item->email }}</td>
                                <td class="px-4 py-2 text-center">{{ $item->alamat }}</td>
                                <td class="px-4 py-2 text-center whitespace-nowrap overflow-hidden text-ellipsis">{{ $item->wilayah }}</td>
                                <td class="px-4 py-2 text-center whitespace-nowrap overflow-hidden text-ellipsis">{{ $item->provinsi }}</td>
                                <td class="px-4 py-2 text-center">
                                    <a href="{{ route('pelanggan.show', $item->id) }}" class="btn btn-info">Lihat</a>
                                    <a href="{{ route('pelanggan.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                                    <form action="{{ route('pelanggan.destroy', $item->id) }}" method="POST" style="display:inline-block;">
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
    </div>
</x-app-layout>
