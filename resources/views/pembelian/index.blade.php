<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Pembelian') }}
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
            <h1 class="text-2xl font-bold">Daftar Pembelian</h1>
            <a href="{{ route('pembelian.create') }}" class="btn btn-light border-custom">Tambah Pembelian</a>
        </div>
        <div class="flex justify-end mt-4">
            <a href="{{ route('vendor.index') }}" class="btn btn-light border-custom mr-2">Daftar Vendor</a>
            <a href="{{ route('pembelian_item.index') }}" class="btn btn-light border-custom">Daftar Pembelian Item</a>
        </div>

        <div class="mt-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs leading-4 font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                ID
                            </th>
                            <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs leading-4 font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Vendor
                            </th>
                            <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs leading-4 font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Tanggal Pembelian
                            </th>
                            <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs leading-4 font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Status
                            </th>
                            <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs leading-4 font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Tanggal Pengiriman
                            </th>
                            <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs leading-4 font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Aksi
                            </th>
                            <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs leading-4 font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Update
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200">
                        @foreach ($pembelian as $p)
                            <tr>
                                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-gray-900 dark:text-gray-100">
                                    {{ $p->id }}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-gray-900 dark:text-gray-100">
                                    {{ $p->vendor->nama }}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-gray-500 dark:text-gray-300">
                                    {{ $p->tgl_pembelian }}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-gray-500 dark:text-gray-300">
                                    {{ $p->status->nama_status }}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-gray-500 dark:text-gray-300">
                                    {{ $p->tgl_pengiriman }}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('pembelian.show', $p->id) }}" class="text-blue-600 hover:text-blue-900">Lihat</a>
                                        <a href="{{ route('pembelian.edit', $p->id) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                        <form action="{{ route('pembelian.destroy', $p->id) }}" method="POST" class="inline" onsubmit="return confirmDelete()">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('pembelian.updateStatus', ['pembelian' => $p->id, 'status' => 2]) }}" class="btn btn-dark">Payment</a>
                                        <a href="{{ route('pembelian.updateStatus', ['pembelian' => $p->id, 'status' => 3]) }}" class="btn btn-dark" onclick="return confirmCancel()">Cancel</a>
                                        <a href="{{ route('pembelian.updateStatus', ['pembelian' => $p->id, 'status' => 4]) }}" class="btn btn-light">Delivered</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $pembelian->links() }}
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    function confirmDelete() {
        return confirm('Data yang dihapus tidak dapat direstorasi?');
    }

    function confirmCancel() {
        return confirm('Pembelian yang di-cancel tidak dapat direstorasi?');
    }
</script>
