<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Pembelian') }}
        </h2>
    </x-slot>

    <link rel="stylesheet" href="{{ asset('assets/css/btn.css') }}">

    <div class="container mx-auto px-4">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="mt-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
            <form id="pembelian-form" action="{{ route('pembelian.storeWithItems') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="id_vendor"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Vendor</label>
                    <div class="flex">
                        <select name="id_vendor" id="id_vendor"
                            class="form-control mt-1 block w-full @error('id_vendor') is-invalid @enderror" required>
                            <option value="">Pilih Vendor</option>
                            @foreach ($vendors as $vendor)
                                <option value="{{ $vendor->id }}"
                                    {{ old('id_vendor') == $vendor->id ? 'selected' : '' }}>
                                    {{ $vendor->nama }}
                                </option>
                            @endforeach
                        </select>
                        <a href="{{ route('vendor.createFromPembelian') }}" class="btn btn-primary ml-2 mt-1">Tambah Vendor</a>
                    </div>
                    @error('id_vendor')
                        <div class="alert alert-danger mt-2 text-red-600">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="tgl_pembelian"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal
                        Pembelian</label>
                    <input type="date" name="tgl_pembelian" id="tgl_pembelian"
                        class="form-control mt-1 block w-full @error('tgl_pembelian') is-invalid @enderror"
                        value="{{ old('tgl_pembelian', date('Y-m-d')) }}" required>
                    @error('tgl_pembelian')
                        <div class="alert alert-danger mt-2 text-red-600">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="id_status"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                    <select name="id_status" id="id_status"
                        class="form-control mt-1 block w-full @error('id_status') is-invalid @enderror" required>
                        @foreach ($statuses as $status)
                            <option value="{{ $status->id }}"
                                {{ old('id_status') == $status->id ? 'selected' : '' }}>
                                {{ $status->nama_status }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_status')
                        <div class="alert alert-danger mt-2 text-red-600">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="id_pengirim"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Pengirim</label>
                    <select name="id_pengirim" id="id_pengirim"
                        class="form-control mt-1 block w-full @error('id_pengirim') is-invalid @enderror">
                        <option value="">Pilih Pengirim</option>
                        @foreach ($pengirims as $pengirim)
                            <option value="{{ $pengirim->id }}"
                                {{ old('id_pengirim') == $pengirim->id ? 'selected' : '' }}>
                                {{ $pengirim->jenis }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_pengirim')
                        <div class="alert alert-danger mt-2 text-red-600">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="tgl_pengiriman"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal
                        Pengiriman</label>
                    <input type="date" name="tgl_pengiriman" id="tgl_pengiriman"
                        class="form-control mt-1 block w-full @error('tgl_pengiriman') is-invalid @enderror"
                        value="{{ old('tgl_pengiriman') }}">
                    @error('tgl_pengiriman')
                        <div class="alert alert-danger mt-2 text-red-600">{{ $message }}</div>
                    @enderror
                </div>

                <div id="items">
                    <div class="item mb-4">
                        <div class="mb-4">
                            <label for="items[0][id_barang]"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Barang</label>
                            <select name="items[0][id_barang]" id="items[0][id_barang]"
                                class="form-control mt-1 block w-full" required>
                                @foreach ($barangs as $barang)
                                    <option value="{{ $barang->id }}">{{ $barang->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="items[0][id_warna]"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Warna</label>
                            <select name="items[0][id_warna]" id="items[0][id_warna]"
                                class="form-control mt-1 block w-full">
                                <option value="">Pilih Warna</option>
                                @foreach ($warnas as $warna)
                                    <option value="{{ $warna->id }}">{{ $warna->warna }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="items[0][harga]"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Harga</label>
                            <input type="number" name="items[0][harga]" id="items[0][harga]"
                                class="form-control mt-1 block w-full" min="0" step="1"
                                onkeydown="return event.keyCode !== 38 && event.keyCode !== 40" onwheel="return false;"
                                required value="">
                        </div>
                    </div>
                </div>

                <div class="flex justify-between items-center">
                    <button type="button" class="btn btn-primary" id="add-item">Tambah Item</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

<script>
    let itemIndex = 1;
    document.getElementById('add-item').addEventListener('click', function() {
        let itemsDiv = document.getElementById('items');
        let newItem = document.createElement('div');
        newItem.classList.add('item', 'mb-4');
        newItem.innerHTML = `
        <div class="mb-4">
            <label for="items[${itemIndex}][id_barang]" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Barang</label>
            <select name="items[${itemIndex}][id_barang]" id="items[${itemIndex}][id_barang]" class="form-control mt-1 block w-full" required>
                @foreach ($barangs as $barang)
                    <option value="{{ $barang->id }}">{{ $barang->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label for="items[${itemIndex}][id_warna]" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Warna</label>
            <select name="items[${itemIndex}][id_warna]" id="items[${itemIndex}][id_warna]" class="form-control mt-1 block w-full">
                <option value="">Pilih Warna</option>
                @foreach ($warnas as $warna)
                    <option value="{{ $warna->id }}">{{ $warna->warna }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label for="items[${itemIndex}][harga]" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Harga</label>
            <input type="number" name="items[${itemIndex}][harga]" id="items[${itemIndex}][harga]" class="form-control mt-1 block w-full" min="0" step="1" onkeydown="return event.keyCode !== 38 && event.keyCode !== 40" onwheel="return false;" required value="">
        </div>
        <div class="flex justify-end mb-4">
            <button type="button" class="btn btn-danger remove-item">Hapus Item</button>
        </div>
    `;
        itemsDiv.appendChild(newItem);
        itemIndex++;
    });

    document.getElementById('items').addEventListener('click', function(e) {
        if (e.target && e.target.classList.contains('remove-item')) {
            e.target.closest('.item').remove();
        }
    });

    document.getElementById('pembelian-form').addEventListener('submit', function(event) {
        const tglPembelian = document.getElementById('tgl_pembelian').value;
        const tglPengiriman = document.getElementById('tgl_pengiriman').value;

        if (tglPengiriman && tglPengiriman < tglPembelian) {
            event.preventDefault();
            alert('Tanggal Pengiriman tidak boleh sebelum Tanggal Pembelian.');
        }
    });
</script>
