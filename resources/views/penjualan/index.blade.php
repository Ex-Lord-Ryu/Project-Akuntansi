<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Penjualan') }}
        </h2>
    </x-slot>

    <link rel="stylesheet" href="{{ asset('assets/css/btn.css') }}">

    <div class="container mx-auto px-4">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('popup_error'))
            <div class="alert alert-danger">
                {{ session('popup_error') }}
            </div>
        @endif

        <div class="flex justify-between items-center mt-6">
            <h1 class="text-2xl font-bold">Daftar Penjualan</h1>
            <a href="{{ route('penjualan.create') }}" class="btn btn-light border-custom">Tambah Penjualan</a>
        </div>
        <div class="flex justify-end mt-4">
            <a href="{{ route('pelanggan.index') }}" class="btn btn-light border-custom mr-2">Daftar Pelanggan</a>
            <a href="{{ route('penjualan_item.index') }}" class="btn btn-light border-custom">Daftar Penjualan Item</a>
        </div>

        <div class="mt-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            ID</th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Pelanggan</th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Tanggal Penjualan</th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Status</th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Tanggal Pengiriman</th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Aksi</th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Update</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200">
                    @foreach ($penjualan as $item)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                {{ $item->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                {{ $item->pelanggan->nama }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                {{ $item->tgl_penjualan }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                {{ $item->status->nama_status }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                {{ $item->tgl_pengiriman ?? 'N/A' }}</td>
                            <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium">
                                <div class="flex space-x-2">
                                    <a href="{{ route('penjualan.show', $item->id) }}" class="text-blue-600 hover:text-blue-900">Lihat</a>
                                    <a href="{{ route('penjualan.edit', $item->id) }}"  class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                    <form action="{{ route('penjualan.destroy', $item->id) }}" method="POST"
                                        class="inline" onsubmit="return confirmDelete()">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                    </form>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium">
                                <div class="flex space-x-2">
                                    <a href="{{ route('penjualan.updateStatus', ['penjualan' => $item->id, 'status' => 2]) }}"
                                        class="btn btn-dark">Payment</a>
                                    <a href="{{ route('penjualan.updateStatus', ['penjualan' => $item->id, 'status' => 3]) }}"
                                        class="btn btn-dark"
                                        onclick="return confirm('Pesanan yang dibatalkan tidak dapat direstorasi.')">Cancel</a>
                                    <a href="{{ route('penjualan.updateStatus', ['penjualan' => $item->id, 'status' => 4]) }}"
                                        class="btn btn-light">Delivered</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-4 mb-4">
                {{ $penjualan->links() }}
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    function confirmDelete() {
        return confirm('Data yang dihapus tidak dapat direstorasi?');
    }
</script>
