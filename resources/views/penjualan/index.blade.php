<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Penjualan') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4">
        <div class="mt-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
            <div class="flex justify-between items-center mt-6">
                <h1 class="text-2xl font-bold">Daftar Penjualan</h1>
                <a href="{{ route('penjualan.create') }}" class="btn btn-primary">Tambah Penjualan</a>
            </div>

            <div class="mt-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <table class="table-auto w-full">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-4 py-2 text-center">ID</th>
                            <th class="px-4 py-2 text-center">Pelanggan</th>
                            <th class="px-4 py-2 text-center">Tanggal Penjualan</th>
                            <th class="px-4 py-2 text-center">Status</th>
                            <th class="px-4 py-2 text-center">Pengirim</th>
                            <th class="px-4 py-2 text-center">Tanggal Pengiriman</th>
                            <th class="px-4 py-2 text-center">Aksi</th>
                            <th class="px-4 py-2 text-center">Table Update</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800">
                        @foreach ($penjualan as $item)
                            <tr class="border-t">
                                <td class="px-4 py-2 text-center">{{ $item->id }}</td>
                                <td class="px-4 py-2 text-center">{{ $item->pelanggan->nama }}</td>
                                <td class="px-4 py-2 text-center">{{ $item->tgl_penjualan }}</td>
                                <td class="px-4 py-2 text-center">{{ $item->status->nama_status }}</td>
                                <td class="px-4 py-2 text-center">{{ $item->pengirim->jenis ?? 'N/A' }}</td>
                                <td class="px-4 py-2 text-center">{{ $item->tgl_penjualan ?? 'N/A' }}</td>
                                <td class="px-4 py-2 text-center">
                                    <a href="{{ route('penjualan.show', $item->id) }}" class="btn btn-info">Lihat</a>
                                    <a href="{{ route('penjualan.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                                    <form action="{{ route('penjualan.destroy', $item->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                    </form>
                                </td>
                                <td class="px-4 py-2 text-center">
                                    <a href="{{ route('penjualan.updateStatus', ['penjualan' => $item->id, 'status' => 3]) }}" class="btn btn-info" 
                                       @if($item->id_status >= 2) disabled @endif>Payment</a>
                                       <a href="{{ route('penjualan.updateStatus', ['penjualan' => $item->id, 'status' => 4]) }}" class="btn btn-warning" 
                                        @if($item->id_status >= 3) disabled @endif>Delivered</a>
                                     <a href="{{ route('penjualan.updateStatus', ['penjualan' => $item->id, 'status' => 5]) }}" class="btn btn-success" 
                                        @if($item->id_status >= 4) disabled @endif>Shipped</a>
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
     </div>
 </x-app-layout>
 
