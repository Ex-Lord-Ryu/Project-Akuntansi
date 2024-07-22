<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Pembelian') }}
        </h2>
    </x-slot>

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
            <form action="{{ route('pembelian.update', $pembelian->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="id_vendor"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Vendor</label>
                    <select name="id_vendor" id="id_vendor"
                        class="form-control mt-1 block w-full @error('id_vendor') is-invalid @enderror" required>
                        @foreach ($vendors as $vendor)
                            <option value="{{ $vendor->id }}"
                                {{ old('id_vendor', $pembelian->id_vendor) == $vendor->id ? 'selected' : '' }}>
                                {{ $vendor->nama }}</option>
                        @endforeach
                    </select>
                    @error('id_vendor')
                        <div class="alert alert-danger mt-2 text-red-600">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="tgl_pembelian"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal Pembelian</label>
                    <input type="date" name="tgl_pembelian" id="tgl_pembelian"
                        class="form-control mt-1 block w-full @error('tgl_pembelian') is-invalid @enderror"
                        value="{{ old('tgl_pembelian', $pembelian->tgl_pembelian) }}" required>
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
                                {{ old('id_status', $pembelian->id_status) == $status->id ? 'selected' : '' }}>
                                {{ $status->nama_status }}</option>
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
                                {{ old('id_pengirim', $pembelian->id_pengirim) == $pengirim->id ? 'selected' : '' }}>
                                {{ $pengirim->jenis }}</option>
                        @endforeach
                    </select>
                    @error('id_pengirim')
                        <div class="alert alert-danger mt-2 text-red-600">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="tgl_pengiriman"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal Pengiriman</label>
                    <input type="date" name="tgl_pengiriman" id="tgl_pengiriman"
                        class="form-control mt-1 block w-full @error('tgl_pengiriman') is-invalid @enderror"
                        value="{{ old('tgl_pengiriman', $pembelian->tgl_pengiriman) }}">
                    @error('tgl_pengiriman')
                        <div class="alert alert-danger mt-2 text-red-600">{{ $message }}</div>
                    @enderror
                </div>
                <div id="items">
                    @foreach ($pembelian->items as $index => $item)
                        <div class="item mb-4">
                            <input type="hidden" name="items[{{ $index }}][id]" value="{{ $item->id }}">
                            <div class="mb-4">
                                <label for="items[{{ $index }}][id_barang]"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Barang</label>
                                <select name="items[{{ $index }}][id_barang]"
                                    id="items[{{ $index }}][id_barang]"
                                    class="form-control mt-1 block w-full @error('items[{{ $index }}][id_barang]') is-invalid @enderror"
                                    required>
                                    @foreach ($barangs as $barang)
                                        <option value="{{ $barang->id }}"
                                            {{ old("items.$index.id_barang", $item->id_barang) == $barang->id ? 'selected' : '' }}>
                                            {{ $barang->nama }}</option>
                                    @endforeach
                                </select>
                                @error("items.$index.id_barang")
                                    <div class="alert alert-danger mt-2 text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="items[{{ $index }}][id_warna]"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Warna</label>
                                <select name="items[{{ $index }}][id_warna]"
                                    id="items[{{ $index }}][id_warna]"
                                    class="form-control mt-1 block w-full @error('items[{{ $index }}][id_warna]') is-invalid @enderror">
                                    <option value="">Pilih Warna</option>
                                    @foreach ($warnas as $warna)
                                        <option value="{{ $warna->id }}"
                                            {{ old("items.$index.id_warna", $item->id_warna) == $warna->id ? 'selected' : '' }}>
                                            {{ $warna->warna }}</option>
                                    @endforeach
                                </select>
                                @error("items.$index.id_warna")
                                    <div class="alert alert-danger mt-2 text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="items[{{ $index }}][harga]"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Harga</label>
                                <input type="number" name="items[{{ $index }}][harga]"
                                    id="items[{{ $index }}][harga]"
                                    class="form-control mt-1 block w-full @error('items[{{ $index }}][harga]') is-invalid @enderror"
                                    min="0" step="1"
                                    onkeydown="return event.keyCode !== 38 && event.keyCode !== 40"
                                    onwheel="return false;" required
                                    value="{{ old("items.$index.harga", $item->harga) }}">
                                @error("items.$index.harga")
                                    <div class="alert alert-danger mt-2 text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="flex justify-end mb-4">
                                <button type="button" class="btn btn-danger remove-item">Hapus Item</button>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="flex justify-between items-center">
                    <a href="{{ route('pembelian.index') }}" class="btn btn-dark">Back</a>
                    <div class="flex space-x-2">
                        <button type="button" class="btn btn-primary" id="add-item">Tambah Item</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
