<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Penjualan') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('penjualan.update', $penjualan->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Pelanggan -->
                        <div class="mb-4">
                            <label for="id_pelanggan" class="block text-sm font-medium text-gray-700">Pelanggan</label>
                            <select name="id_pelanggan" id="id_pelanggan" class="form-select mt-1 block w-full">
                                @foreach ($pelanggans as $pelanggan)
                                    <option value="{{ $pelanggan->id }}" {{ $pelanggan->id == $penjualan->id_pelanggan ? 'selected' : '' }}>{{ $pelanggan->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Tanggal Penjualan -->
                        <div class="mb-4">
                            <label for="tgl_penjualan" class="block text-sm font-medium text-gray-700">Tanggal Penjualan</label>
                            <input type="datetime-local" name="tgl_penjualan" id="tgl_penjualan" class="form-input mt-1 block w-full" value="{{ $penjualan->tgl_penjualan }}" required readonly>
                        </div>

                        <!-- Status -->
                        <div class="mb-4">
                            <label for="id_status" class="block text-sm font-medium text-gray-700">Status</label>
                            <select name="id_status" id="id_status" class="form-select mt-1 block w-full">
                                @foreach ($statuses as $status)
                                    <option value="{{ $status->id }}" {{ $status->id == $penjualan->id_status ? 'selected' : '' }}>{{ $status->nama_status }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Pengirim -->
                        <div class="mb-4">
                            <label for="id_pengirim" class="block text-sm font-medium text-gray-700">Pengirim</label>
                            <select name="id_pengirim" id="id_pengirim" class="form-select mt-1 block w-full">
                                <option value="">Pilih Pengirim</option>
                                @foreach ($pengirims as $pengirim)
                                    <option value="{{ $pengirim->id }}" {{ $pengirim->id == $penjualan->id_pengirim ? 'selected' : '' }}>{{ $pengirim->jenis }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Tanggal Pengiriman -->
                        <div class="mb-4">
                            <label for="tgl_pengiriman" class="block text-sm font-medium text-gray-700">Tanggal Pengiriman</label>
                            <input type="datetime-local" name="tgl_pengiriman" id="tgl_pengiriman" class="form-input mt-1 block w-full" value="{{ $penjualan->tgl_pengiriman }}" readonly>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="btn btn-primary">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
