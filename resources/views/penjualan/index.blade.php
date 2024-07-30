<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Penjualan') }}
        </h2>
    </x-slot>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('assets/css/btn.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

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

        <div class="mt-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
            <div class="flex justify-end mb-4">
                <form action="{{ route('penjualan.index') }}" method="GET" class="flex items-center">
                    <input type="text" name="search" placeholder="Cari Penjualan..."
                        value="{{ request()->query('search') }}" class="form-input rounded-l border-0">
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
                    <button id="payment-button" class="btn btn-dark" disabled>
                        <i class="fas fa-credit-card"></i> Payment
                    </button>
                    <button id="cancel-button" class="btn btn-dark" disabled>
                        <i class="fas fa-ban"></i> Cancel
                    </button>
                    <button id="delivered-button" class="btn btn-light" disabled>
                        <i class="fas fa-truck"></i> Delivered
                    </button>
                </div>
                <div class="flex justify-end space-x-2">
                    <a href="{{ route('pelanggan.index') }}" class="btn btn-light border-custom">
                        <i class="fas fa-list"></i> Pelanggan
                    </a>
                    <a href="{{ route('penjualan_item.index') }}" class="btn btn-light border-custom">
                        <i class="fas fa-list"></i> Penjualan Item
                    </a>
                    {{-- <a href="{{ route('penjualan.create') }}" class="btn btn-light border-custom">
                        <i class="fas fa-plus"></i> Penjualan
                    </a> --}}
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th
                                class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs leading-4 font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                ID
                            </th>
                            <th
                                class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs leading-4 font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Pelanggan
                            </th>
                            <th
                                class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs leading-4 font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Tanggal Penjualan
                            </th>
                            <th
                                class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs leading-4 font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Status
                            </th>
                            <th
                                class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs leading-4 font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Tanggal Penerimaan
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200" id="table-body">
                        @foreach ($penjualan as $item)
                            <tr data-id="{{ $item->id }}" class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                <td
                                    class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-gray-900 dark:text-gray-100">
                                    {{ $item->id }}
                                </td>
                                <td
                                    class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-gray-900 dark:text-gray-100">
                                    {{ $item->pelanggan->nama }}
                                </td>
                                <td
                                    class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-gray-500 dark:text-gray-300">
                                    {{ $item->tgl_penjualan }}
                                </td>
                                <td
                                    class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-gray-500 dark:text-gray-300 status-cell">
                                    {{ $item->status->nama_status }}
                                </td>
                                <td
                                    class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-gray-500 dark:text-gray-300">
                                    {{ $item->tgl_penerimaan ?? 'N/A' }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $penjualan->links() }}
            </div>
        </div>
    </div>
</x-app-layout>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const tableBody = document.getElementById('table-body');
    let selectedRowId = null;
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    tableBody.addEventListener('click', function(event) {
        const rows = tableBody.getElementsByTagName('tr');
        for (let row of rows) {
            row.classList.remove('bg-blue-100', 'text-bold', 'border-l-4', 'border-blue-500');
        }

        const selectedRow = event.target.closest('tr');
        selectedRow.classList.add('bg-blue-100', 'text-bold', 'border-l-4', 'border-blue-500');
        selectedRowId = selectedRow.getAttribute('data-id');

        document.getElementById('view-button').disabled = false;
        document.getElementById('edit-button').disabled = false;
        document.getElementById('delete-button').disabled = false;
        document.getElementById('payment-button').disabled = false;
        document.getElementById('cancel-button').disabled = false;
        document.getElementById('delivered-button').disabled = false;
    });

    document.getElementById('view-button').addEventListener('click', function() {
        if (selectedRowId) {
            window.location.href = `/penjualan/${selectedRowId}`;
        }
    });

    document.getElementById('edit-button').addEventListener('click', function() {
        if (selectedRowId) {
            window.location.href = `/penjualan/${selectedRowId}/edit`;
        }
    });

    document.getElementById('delete-button').addEventListener('click', function() {
        if (selectedRowId) {
            if (confirm('Data yang dihapus tidak dapat direstorasi?')) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `/penjualan/${selectedRowId}`;
                form.innerHTML = `
                    @csrf
                    @method('DELETE')
                `;
                document.body.appendChild(form);
                form.submit();
            }
        }
    });

    document.getElementById('payment-button').addEventListener('click', function() {
        if (selectedRowId) {
            if (confirm('Anda yakin ingin memproses pembayaran untuk pesanan ini? Tindakan ini tidak dapat diurungkan.')) {
                updateStatus(selectedRowId, 2);
            }
        }
    });

    document.getElementById('cancel-button').addEventListener('click', function() {
        if (selectedRowId) {
            if (confirm('Anda yakin ingin membatalkan pesanan ini? Tindakan ini tidak dapat diurungkan.')) {
                updateStatus(selectedRowId, 3);
            }
        }
    });

    document.getElementById('delivered-button').addEventListener('click', function() {
        if (selectedRowId) {
            if (confirm('Anda yakin ingin menandai pesanan ini sebagai telah dikirim? Tindakan ini tidak dapat diurungkan.')) {
                updateStatus(selectedRowId, 4);
            }
        }
    });

    function updateStatus(id, status) {
        fetch(`/penjualan/${id}/status/${status}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Status berhasil diperbarui');
                    window.location.reload();  // Refresh the page after status update
                } else {
                    alert('Gagal memperbarui status');
                }
            })
            .catch(error => console.error('Error:', error));
    }
});
</script>
