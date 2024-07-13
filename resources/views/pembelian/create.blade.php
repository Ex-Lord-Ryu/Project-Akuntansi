<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Pembelian') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4">
        <div class="mt-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
            <form action="{{ route('pembelian.storeWithItems') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="id_vendor" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Vendor</label>
                    <select name="id_vendor" id="id_vendor" class="form-control mt-1 block w-full @error('id_vendor') is-invalid @enderror" required>
                        @foreach ($vendors as $vendor)
                            <option value="{{ $vendor->id }}">{{ $vendor->nama }}</option>
                        @endforeach
                    </select>
                    @error('id_vendor')
                        <div class="alert alert-danger mt-2 text-red-600">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="tgl_pembelian" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal Pembelian</label>
                    <input type="datetime-local" name="tgl_pembelian" id="tgl_pembelian" class="form-control mt-1 block w-full @error('tgl_pembelian') is-invalid @enderror" required>
                    @error('tgl_pembelian')
                        <div class="alert alert-danger mt-2 text-red-600">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="id_status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                    <select name="id_status" id="id_status" class="form-control mt-1 block w-full @error('id_status') is-invalid @enderror" required>
                        @foreach ($statuses as $status)
                            <option value="{{ $status->id }}">{{ $status->nama_status }}</option>
                        @endforeach
                    </select>
                    @error('id_status')
                        <div class="alert alert-danger mt-2 text-red-600">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="id_pengirim" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Pengirim</label>
                    <select name="id_pengirim" id="id_pengirim" class="form-control mt-1 block w-full @error('id_pengirim') is-invalid @enderror">
                        <option value="">Pilih Pengirim</option>
                        @foreach ($pengirims as $pengirim)
                            <option value="{{ $pengirim->id }}">{{ $pengirim->jenis }}</option>
                        @endforeach
                    </select>
                    @error('id_pengirim')
                        <div class="alert alert-danger mt-2 text-red-600">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="tgl_pengiriman" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal Pengiriman</label>
                    <input type="datetime-local" name="tgl_pengiriman" id="tgl_pengiriman" class="form-control mt-1 block w-full @error('tgl_pengiriman') is-invalid @enderror">
                    @error('tgl_pengiriman')
                        <div class="alert alert-danger mt-2 text-red-600">{{ $message }}</div>
                    @enderror
                </div>

                <div id="items">
                    <div class="mb-4">
                        <label for="items[0][id_barang]" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Barang</label>
                        <select name="items[0][id_barang]" id="items[0][id_barang]" class="form-control mt-1 block w-full @error('items[0][id_barang]') is-invalid @enderror" required>
                            @foreach ($barangs as $barang)
                                <option value="{{ $barang->id }}">{{ $barang->nama }}</option>
                            @endforeach
                        </select>
                        @error('items[0][id_barang]')
                            <div class="alert alert-danger mt-2 text-red-600">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="items[0][qty]" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Qty</label>
                        <input type="number" name="items[0][qty]" id="items[0][qty]" class="form-control mt-1 block w-full @error('items[0][qty]') is-invalid @enderror" required>
                        @error('items[0][qty]')
                            <div class="alert alert-danger mt-2 text-red-600">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="items[0][harga]" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Harga</label>
                        <input type="number" name="items[0][harga]" id="items[0][harga]" class="form-control mt-1 block w-full @error('items[0][harga]') is-invalid @enderror" required>
                        @error('items[0][harga]')
                            <div class="alert alert-danger mt-2 text-red-600">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="items[0][ppn]" class="block text-sm font-medium text-gray-700 dark:text-gray-300">PPN</label>
                        <input type="number" name="items[0][ppn]" id="items[0][ppn]" class="form-control mt-1 block w-full @error('items[0][ppn]') is-invalid @enderror" value="11" required>
                        @error('items[0][ppn]')
                            <div class="alert alert-danger mt-2 text-red-600">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="flex justify-end">
                    <button type="button" id="addItem" class="btn btn-primary mr-2">Tambah Item</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

<script>
    let itemIndex = 1;
    document.getElementById('addItem').addEventListener('click', function () {
        let itemsDiv = document.getElementById('items');
        let newItem = document.createElement('div');
        newItem.classList.add('mb-4');
        newItem.innerHTML = `
            <div class="mb-4">
                <label for="items[${itemIndex}][id_barang]" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Barang</label>
                <select name="items[${itemIndex}][id_barang]" id="items[${itemIndex}][id_barang]" class="form-control mt-1 block w-full @error('items[${itemIndex}][id_barang]') is-invalid @enderror" required>
                    @foreach ($barangs as $barang)
                        <option value="{{ $barang->id }}">{{ $barang->nama }}</option>
                    @endforeach
                </select>
                @error('items[${itemIndex}][id_barang]')
                    <div class="alert alert-danger mt-2 text-red-600">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-4">
                <label for="items[${itemIndex}][qty]" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Qty</label>
                <input type="number" name="items[${itemIndex}][qty]" id="items[${itemIndex}][qty]" class="form-control mt-1 block w-full @error('items[${itemIndex}][qty]') is-invalid @enderror" required>
                @error('items[${itemIndex}][qty]')
                    <div class="alert alert-danger mt-2 text-red-600">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-4">
                <label for="items[${itemIndex}][harga]" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Harga</label>
                <input type="number" name="items[${itemIndex}][harga]" id="items[${itemIndex}][harga]" class="form-control mt-1 block w-full @error('items[${itemIndex}][harga]') is-invalid @enderror" required>
                @error('items[${itemIndex}][harga]')
                    <div class="alert alert-danger mt-2 text-red-600">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-4">
                <label for="items[${itemIndex}][ppn]" class="block text-sm font-medium text-gray-700 dark:text-gray-300">PPN</label>
                <input type="number" name="items[${itemIndex}][ppn]" id="items[${itemIndex}][ppn]" class="form-control mt-1 block w-full @error('items[${itemIndex}][ppn]') is-invalid @enderror" value="10" required>
                @error('items[${itemIndex}][ppn]')
                    <div class="alert alert-danger mt-2 text-red-600">{{ $message }}</div>
                @enderror
            </div>
        `;
        itemsDiv.appendChild(newItem);
        itemIndex++;
    });
</script>
               
