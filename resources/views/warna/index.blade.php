<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Warna') }}
        </h2>
    </x-slot>

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
                <form action="{{ route('warna.index') }}" method="GET" class="flex items-center">
                    <input type="text" name="search" placeholder="Cari nama warna..." value="{{ request()->query('search') }}" class="form-input rounded-l border-0">
                    <button type="submit" class="btn btn-light border-custom rounded-r ml-2">
                        <i class="fas fa-search"></i> Cari
                    </button>
                </form>
            </div>
            <div class="flex justify-between mb-4">
                <div class="flex justify-start space-x-2">
                    <button id="edit-button" class="btn btn-light border-custom" disabled>
                        <i class="fas fa-edit"></i> Edit
                    </button>
                    <button id="delete-button" class="btn btn-light border-custom" disabled>
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </div>
                <div class="flex justify-end space-x-2">
                    <a href="{{ route('warna.create') }}" class="btn btn-light border-custom">
                        <i class="fas fa-plus"></i> Warna
                    </a>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 text-center">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                ID
                            </th>
                            <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Warna
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200" id="table-body">
                        @foreach ($warna as $item)
                            <tr data-id="{{ $item->id }}" class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                <td class="px-6 py-4 whitespace-no-wrap text-sm font-medium text-gray-900 dark:text-gray-100">
                                    {{ $item->id }}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap text-sm font-medium text-gray-900 dark:text-gray-100">
                                    {{ $item->warna }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $warna->links() }}
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const tableBody = document.getElementById('table-body');
        let selectedRowId = null;

        tableBody.addEventListener('click', function (event) {
            const rows = tableBody.getElementsByTagName('tr');
            for (let row of rows) {
                row.classList.remove('bg-blue-100', 'text-bold', 'border-l-4', 'border-blue-500');
            }

            const selectedRow = event.target.closest('tr');
            selectedRow.classList.add('bg-blue-100', 'text-bold', 'border-l-4', 'border-blue-500');
            selectedRowId = selectedRow.getAttribute('data-id');

            document.getElementById('edit-button').disabled = false;
            document.getElementById('delete-button').disabled = false;
        });

        document.getElementById('edit-button').addEventListener('click', function () {
            if (selectedRowId) {
                window.location.href = `/warna/${selectedRowId}/edit`;
            }
        });

        document.getElementById('delete-button').addEventListener('click', function () {
            if (selectedRowId) {
                if (confirm('Data yang dihapus tidak dapat direstorasi?')) {
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = `/warna/${selectedRowId}`;
                    form.innerHTML = `
                        @csrf
                        @method('DELETE')
                    `;
                    document.body.appendChild(form);
                    form.submit();
                }
            }
        });
    });

    function ConfirmDelete() {
        return confirm('Data yang dihapus tidak dapat direstorasi?');
    }
</script>