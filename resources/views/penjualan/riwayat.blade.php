<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Riwayat Penjualan') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4 py-6">
        <div class="mt-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
            <h3 class="text-lg font-medium text-gray-800 dark:text-gray-200">Riwayat Penjualan Anda</h3>
            @if ($penjualans->isEmpty())
                <p class="text-center text-gray-500 dark:text-gray-300">Tidak ada riwayat penjualan</p>
            @else
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Tanggal Penjualan</th>
                            <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Pelanggan</th>
                            <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Pengirim</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-600">
                        @foreach ($penjualans as $penjualan)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $penjualan->tgl_penjualan }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $penjualan->pelanggan->nama ?? 'N/A' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $penjualan->status->nama_status }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $penjualan->pengirim->jenis ?? 'N/A' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-4">
                    {{ $penjualans->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
