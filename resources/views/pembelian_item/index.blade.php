<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Pembelian Item') }}
        </h2>
    </x-slot>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('assets/css/btn.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <div class="container mx-auto px-4">
        <div class="mt-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
            <div class="flex justify-end mb-4">
                <form action="{{ route('pembelian_item.index') }}" method="GET" class="flex items-center">
                    <input type="text" name="search" placeholder="Cari..." value="{{ request()->query('search') }}" class="form-input rounded-l border-0">
                    <button type="submit" class="btn btn-light border-custom rounded-r ml-2">
                        <i class="fas fa-search"></i> Cari
                    </button>
                </form>
            </div>
            <div class="flex justify-between mb-4">
                <div class="flex justify-start space-x-2">
                    <button id="view-button" class="btn btn-light border-custom" disabled>
                        <i class="fas fa-eye"></i> Lihat
                    </button>
                    <button id="edit-button" class="btn btn-light border-custom" disabled>
                        <i class="fas fa-edit"></i> Edit
                    </button>
                    <button id="delete-button" class="btn btn-light border-custom" disabled>
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </div>
                <div class="flex justify-end space-x-2">
                    <a href="{{ route('pembelian.index') }}" class="btn btn-light border-custom">
                        <i class="fas fa-list"></i> Pembelian
                    </a>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 text-center">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                ID Pembelian
                            </th>
                            <th class="px-6 py-3 text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Barang
                            </th>
                            <th class="px-6 py-3 text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Warna
                            </th>
                            <th class="px-6 py-3 text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Tanggal Pembelian
                            </th>
                            <th class="px-6 py-3 text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Harga
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200" id="table-body">
                        @foreach ($pembelianItems as $item)
                            <tr data-id="{{ $item->id }}" data-pembelian-id="{{ $item->id_pembelian }}" class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                <td class="px-6 py-4 whitespace-no-wrap text-sm font-medium text-gray-900 dark:text-gray-100">
                                    {{ $item->id_pembelian }}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap text-sm text-gray-500 dark:text-gray-300">
                                    {{ $item->barang->nama }}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap text-sm text-gray-500 dark:text-gray-300">
                                    {{ $item->warna->warna ?? 'N/A' }}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap text-sm text-gray-500 dark:text-gray-300">
                                    {{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap text-sm text-gray-500 dark:text-gray-300">
                                    {{ 'Rp ' . number_format($item->harga, 0, ',', '.') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $pembelianItems->links() }}
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tableBody = document.getElementById('table-body');
        let selectedRowId = null;
        let selectedPembelianId = null;
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        tableBody.addEventListener('click', function(event) {
            const rows = tableBody.getElementsByTagName('tr');
            for (let row of rows) {
                row.classList.remove('bg-blue-100', 'font-bold', 'border-l-4', 'border-blue-500');
            }

            const selectedRow = event.target.closest('tr');
            selectedRow.classList.add('bg-blue-100', 'font-bold', 'border-l-4', 'border-blue-500');
            selectedRowId = selectedRow.getAttribute('data-id');
            selectedPembelianId = selectedRow.getAttribute('data-pembelian-id');

            document.getElementById('view-button').disabled = false;
            document.getElementById('edit-button').disabled = false;
            document.getElementById('delete-button').disabled = false;
        });

        document.getElementById('view-button').addEventListener('click', function() {
            if (selectedPembelianId) {
                window.location.href = `/pembelian/${selectedPembelianId}`;
            }
        });

        document.getElementById('edit-button').addEventListener('click', function() {
            if (selectedPembelianId) {
                window.location.href = `/pembelian/${selectedPembelianId}/edit`;
            }
        });

        document.getElementById('delete-button').addEventListener('click', function() {
            if (selectedRowId) {
                if (confirm('Apakah Anda yakin ingin menghapus item ini?')) {
                    fetch(`/pembelian_items/${selectedRowId}`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log('Response:', data);
                        if (data.success) {
                            alert('Item berhasil dihapus');
                            location.reload(); // Reload the page to see the updated list
                        } else {
                            alert('Gagal menghapus item');
                        }
                    })
                    .catch(error => console.error('Error:', error));
                }
            }
        });
    });
</script>
