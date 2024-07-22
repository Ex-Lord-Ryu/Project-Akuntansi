<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Penjualan') }}
        </h2>
    </x-slot>

    <link rel="stylesheet" href="{{ asset('assets/css/btn.css') }}">

    <div class="container mx-auto px-4 py-6">
        <form action="{{ route('penjualan.storeWithItems') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="id_pelanggan" class="block text-sm font-medium text-gray-700">Pelanggan</label>
                <div class="flex">
                    <select name="id_pelanggan" id="id_pelanggan" class="form-select mt-1 block w-full">
                        <option value="">Pilih Pelanggan</option>
                        @foreach ($pelanggans as $pelanggan)
                            <option value="{{ $pelanggan->id }}">{{ $pelanggan->nama }}</option>
                        @endforeach
                    </select>
                    <a href="{{ route('pelanggan.createFromPenjualan') }}" class="btn btn-primary ml-2 mt-1">Tambah
                        Pelanggan</a>
                </div>
                @error('id_pelanggan')
                    <div class="alert alert-danger mt-2 text-red-600">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-4">
                <label for="tgl_penjualan" class="block text-sm font-medium text-gray-700">Tanggal Penjualan</label>
                <input type="date" name="tgl_penjualan" id="tgl_penjualan" class="form-input mt-1 block w-full"
                    required>
            </div>
            <div class="mb-4">
                <label for="id_status" class="block text-sm font-medium text-gray-700">Status</label>
                <select name="id_status" id="id_status" class="form-select mt-1 block w-full">
                    @foreach ($statuses as $status)
                        <option value="{{ $status->id }}">{{ $status->nama_status }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="id_pengirim" class="block text-sm font-medium text-gray-700">Pengirim</label>
                <select name="id_pengirim" id="id_pengirim" class="form-select mt-1 block w-full">
                    <option value="">Pilih Pengirim</option>
                    @foreach ($pengirims as $pengirim)
                        <option value="{{ $pengirim->id }}">{{ $pengirim->jenis }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="tgl_penerimaan" class="block text-sm font-medium text-gray-700">Tanggal Penerimaan</label>
                <input type="date" name="tgl_penerimaan" id="tgl_penerimaan" class="form-input mt-1 block w-full"
                    required>
            </div>
            <div class="mb-4">
                <label for="items" class="block text-sm font-medium text-gray-700">Item Penjualan</label>
                <div id="items-container">
                    <div class="flex space-x-4 mb-4">
                        <div class="w-1/3">
                            <label for="items[0][stok_id]" class="block text-sm font-medium text-gray-700">Stok</label>
                            <select name="items[0][stok_id]" class="form-select mt-1 block w-full">
                                @foreach ($stokAvailable as $stok)
                                    <option value="{{ $stok->id }}">{{ $stok->barang->nama }} -
                                        {{ $stok->no_rangka }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="w-1/3">
                            <label for="items[0][harga]" class="block text-sm font-medium text-gray-700">Harga</label>
                            <input type="number" name="items[0][harga]" class="form-input mt-1 block w-full" required>
                        </div>
                    </div>
                </div>
                <button type="button" id="add-item" class="btn btn-light border-custom">Tambah Item</button>
            </div>
            <div class="mt-4">
                <button type="submit" class="btn btn-light border-custom">Simpan Penjualan</button>
            </div>
        </form>
    </div>
</x-app-layout>

<script>
    let itemCount = 1;

    document.getElementById('add-item').addEventListener('click', () => {
        const itemsContainer = document.getElementById('items-container');
        const newItem = document.createElement('div');
        newItem.classList.add('flex', 'space-x-4', 'mb-4');

        newItem.innerHTML = `
            <div class="w-1/3">
                <label for="items[${itemCount}][stok_id]" class="block text-sm font-medium text-gray-700">Stok</label>
                <select name="items[${itemCount}][stok_id]" class="form-select mt-1 block w-full">
                    @foreach ($stokAvailable as $stok)
                        <option value="{{ $stok->id }}">{{ $stok->barang->nama }} - {{ $stok->no_rangka }}</option>
                    @endforeach
                </select>
            </div>
            <div class="w-1/3">
                <label for="items[${itemCount}][harga]" class="block text-sm font-medium text-gray-700">Harga</label>
                <input type="number" name="items[${itemCount}][harga]" class="form-input mt-1 block w-full" required>
            </div>     
            <div class="flex justify-end mb-4">
                <button type="button" class="btn btn-danger remove-item">Hapus Item</button>
            </div>
        `;

        itemsContainer.appendChild(newItem);
        itemCount++;
    });

    document.getElementById('items').addEventListener('click', function(e) {
        if (e.target && e.target.classList.contains('remove-item')) {
            e.target.closest('.item').remove();
        }
    });

    document.getElementById('pembelian-form').addEventListener('submit', function(event) {
        const tglPenjualan = document.getElementById('tgl_penejualan').value;
        const tglPenerimaan = document.getElementById('tgl_penerimaan').value;

        if (tglPenerimaan && tglPenerimaan < tglPenjualan) {
            event.preventDefault();
            alert('Tanggal Penerimaan tidak boleh sebelum Tanggal Pembelian.');
        }
    });
</script>
