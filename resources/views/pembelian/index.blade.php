<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Pembelian') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center mt-6">
            <h1 class="text-2xl font-bold">Daftar Pembelian</h1>
            <a href="{{ route('pembelian.create') }}" class="btn btn-primary">Tambah Pembelian</a>
        </div>

        <div class="mt-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
            <table class="table-auto w-full">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="px-4 py-2 text-center">ID</th>
                        <th class="px-4 py-2 text-center">Vendor</th>
                        <th class="px-4 py-2 text-center">Tanggal Pembelian</th>
                        <th class="px-4 py-2 text-center">Status</th>
                        <th class="px-4 py-2 text-center">Pengirim</th>
                        <th class="px-4 py-2 text-center">Tanggal Pengiriman</th>
                        <th class="px-4 py-2 text-center">Aksi</th>
                        <th class="px-4 py-2 text-center">Table Update</th> <!-- New Column -->
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800">
                    @foreach ($pembelian as $item)
                        <tr class="border-t">
                            <td class="px-4 py-2 text-center">{{ $item->id }}</td>
                            <td class="px-4 py-2 text-center">{{ $item->vendor->nama }}</td>
                            <td class="px-4 py-2 text-center">{{ $item->tgl_pembelian }}</td>
                            <td class="px-4 py-2 text-center">{{ $item->status->nama_status }}</td>
                            <td class="px-4 py-2 text-center">{{ $item->pengirim->jenis ?? 'N/A' }}</td>
                            <td class="px-4 py-2 text-center">{{ $item->tgl_pengiriman ?? 'N/A' }}</td>
                            <td class="px-4 py-2 text-center">
                                <a href="{{ route('pembelian.show', $item->id) }}" class="btn btn-info">Lihat</a>
                                <a href="{{ route('pembelian.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('pembelian.destroy', $item->id) }}" method="POST"
                                    style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                </form>
                            </td>
                            <td class="px-4 py-2 text-center">
                                <a href="{{ route('pembelian.updateStatus', ['pembelian' => $item->id, 'status' => 2]) }}"
                                    class="btn btn-info" @if ($item->id_status >= 2) disabled @endif>Payment</a>
                                <a href="{{ route('pembelian.updateStatus', ['pembelian' => $item->id, 'status' => 3]) }}"
                                    class="btn btn-warning"
                                    @if ($item->id_status >= 3) disabled @endif>Delivered</a>
                                <a href="{{ route('pembelian.updateStatus', ['pembelian' => $item->id, 'status' => 4]) }}"
                                    class="btn btn-success"
                                    @if ($item->id_status >= 4) disabled @endif>Shipped</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-4 mb-4">
                {{ $pembelian->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
