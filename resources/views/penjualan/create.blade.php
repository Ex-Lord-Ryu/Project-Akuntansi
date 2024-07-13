<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Penjualan') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4">
        <div class="mt-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
            <form action="{{ route('penjualan.storeWithItems') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="id_pelanggan" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Pelanggan</label>
                    <select name="id_pelanggan" id="id_pelanggan" class="form-control mt-1 block w-full" required>
                        @foreach ($pelanggans as $pelanggan)
                            <option value="{{ $pelanggan->id }}">{{ $pelanggan->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="tgl_penjualan" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal Penjualan</label>
                    <input type="datetime-local" name="tgl_penjualan" id="tgl_penjualan" class="form-control mt-1 block w-full" required>
                </div>
                <div class="mb-4">
                    <label for="id_status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                    <select name="id_status" id="id_status" class="form-control mt-1 block w-full" required>
                        @foreach ($statuses as $status)
                            <option value="{{ $status->id }}">{{ $status->nama_status }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="id_pengirim" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Pengirim</label>
                    <select name="id_pengirim" id="id_pengirim" class="form-control mt-1 block w-full">
                        <option value="">Pilih Pengirim</option>
                        @foreach ($pengirims as $pengirim)
                            <option value="{{ $pengirim->id }}">{{ $pengirim->jenis }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="tgl_pengiriman" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal Pengiriman</label>
                    <input type="datetime-local" name="tgl_pengiriman" id="tgl_pengiriman" class="form-control mt-1 block w-full">
                </div>

                <!-- Penjualan Items -->
                <div id="items">
                    <div class="mb-4">
                        <label for="items[0][id_barang]" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Barang</label>
                        <select name="items[0][id_barang]" id="items[0][id_barang]" class="form-control mt-1 block w-full" required>
                            @foreach ($barangs as $barang)
                                <option value="{{ $barang->id }}">{{ $barang->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="items[0][qty]" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Quantity</label>
                        <input type="number" name="items[0][qty]" id="items[0][qty]" class="form-control mt-1 block w-full" required>
                    </div>
                    <div class="mb-4">
                        <label for="items[0][harga]" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Harga</label>
                        <input type="number" name="items[0][harga]" id="items[0][harga]" class="form-control mt-1 block w-full" required>
                    </div>
                    <div class="mb-4">
                        <label for="items[0][ppn]" class="block text-sm font-medium text-gray-700 dark:text-gray-300">PPN</label>
                        <input type="number" name="items[0][ppn]" id="items[0][ppn]" class="form-control mt-1 block w-full" value="11" required
                    </div>
                </div>
                <div class="flex justify-end">
                    <button type="button" class="btn btn-secondary" id="add-item">Tambah Item</button>
                </div>
                <div class="flex justify-end mt-4">
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

<script>
    document.getElementById('add-item').addEventListener('click', function () {
        const items = document.getElementById('items');
        const itemCount = items.children.length;

        const itemHtml = `
            <div class="mb-4">
                <label for="items[${itemCount}][id_barang]" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Barang</label>
                <select name="items[${itemCount}][id_barang]" id="items[${itemCount}][id_barang]" class="form-control mt-1 block w-full" required>
                    @foreach ($barangs as $barang)
                        <option value="{{ $barang->id }}">{{ $barang->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="items[${itemCount}][qty]" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Quantity</label>
                <input type="number" name="items[${itemCount}][qty]" id="items[${itemCount}][qty]" class="form-control mt-1 block w-full" required>
            </div>
            <div class="mb-4">
                <label for="items[${itemCount}][harga]" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Harga</label>
                <input type="number" name="items[${itemCount}][harga]" id="items[${itemCount}][harga]" class="form-control mt-1 block w-full" required>
            </div>
            <div class="mb-4">
                <label for="items[${itemCount}][ppn]" class="block text-sm font-medium text-gray-700 dark:text-gray-300">PPN</label>
                <input type="number" name="items[${itemCount}][ppn]" id="items[${itemCount}][ppn]" class="form-control mt-1 block w-full" required>
            </div>
        `;
        
        const div = document.createElement('div');
        div.innerHTML = itemHtml;
        items.appendChild(div);
    });
</script>
