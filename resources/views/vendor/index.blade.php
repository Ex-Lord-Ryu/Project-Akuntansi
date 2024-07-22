<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Vendor') }}
        </h2>
    </x-slot>

    <link rel="stylesheet" href="{{ asset('assets/css/btn.css') }}">

    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center mt-6">
            <h1 class="text-2xl font-bold">Daftar Vendor</h1>
            <a href="{{ route('vendor.create') }}" class="btn btn-light border-custom">Tambah Vendor</a>
        </div>
        <div class="flex justify-end mt-4">
            <a href="{{ route('pembelian.index') }}" class="btn btn-light border-custom ">Daftar Pembelian</a>
        </div>

        <div class="mt-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-8"> <!-- Added mb-8 class here -->
            <table class="table-auto w-full mb-4"> <!-- Added mb-4 class here -->
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="px-4 py-2">ID</th>
                        <th class="px-4 py-2">Nama</th>
                        <th class="px-4 py-2">Alamat</th>
                        <th class="px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800">
                    @foreach ($vendors as $item)
                        <tr class="border-t">
                            <td class="px-4 py-2">{{ $item->id }}</td>
                            <td class="py-2">{{ $item->nama }}</td>
                            <td class="px-4 py-2">{{ $item->alamat }}</td>
                            <td class="px-4 py-2">
                                <div class="flex flex-col items-center">
                                    <a href="{{ route('vendor.edit', $item->id) }}" class="btn btn-dark mb-2 btn-action">Edit</a>
                                    <form action="{{ route('vendor.destroy', $item->id) }}" method="POST" 
                                        class="mb-2" onclick="return ConfirmDelete()">
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
            <div class="mt-4"> <!-- Added mb-4 class here -->
                {{ $vendors->links() }}
            </div>
        </div>
        <div class="flex justify-between items-center mt-6">
        </div>
    </div>
</x-app-layout>

<script>
    function ConfirmDelete() {
        return confirm('Data yang dihapus tidak dapat direstorasi');
    }
</script>


