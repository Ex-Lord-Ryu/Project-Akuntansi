<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Pembelian') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('pembelian.update', $pembelian->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Vendor -->
                        <div class="mb-4">
                            <label for="id_vendor" class="block text-sm font-medium text-gray-700">Vendor</label>
                            <select name="id_vendor" id="id_vendor" class="form-select mt-1 block w-full">
                                @foreach ($vendors as $vendor)
                                    <option value="{{ $vendor->id }}" {{ $vendor->id == $pembelian->id_vendor ? 'selected' : '' }}>{{ $vendor->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Tanggal Pembelian -->
                        <div class="mb-4">
                            <label for="tgl_pembelian" class="block text-sm font-medium text-gray-700">Tanggal Pembelian</label>
                            <input type="text" name="tgl_pembelian" id="tgl_pembelian" class="form-input mt-1 block w-full" value="{{ $pembelian->tgl_pembelian }}" readonly>
                        </div>

                        <!-- Status -->
                        <div class="mb-4">
                            <label for="id_status" class="block text-sm font-medium text-gray-700">Status</label>
                            <select name="id_status" id="id_status" class="form-select mt-1 block w-full">
                                @foreach ($statuses as $status)
                                    <option value="{{ $status->id }}" {{ $status->id == $pembelian->id_status ? 'selected' : '' }}>{{ $status->nama_status }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Pengirim -->
                        <div class="mb-4">
                            <label for="id_pengirim" class="block text-sm font-medium text-gray-700">Pengirim</label>
                            <select name="id_pengirim" id="id_pengirim" class="form-select mt-1 block w-full">
                                <option value="">Pilih Pengirim</option>
                                @foreach ($pengirims as $pengirim)
                                    <option value="{{ $pengirim->id }}" {{ $pengirim->id == $pembelian->id_pengirim ? 'selected' : '' }}>{{ $pengirim->jenis }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Tanggal Pengiriman -->
                        <div class="mb-4">
                            <label for="tgl_pengiriman" class="block text-sm font-medium text-gray-700">Tanggal Pengiriman</label>
                            <input type="text" name="tgl_pengiriman" id="tgl_pengiriman" class="form-input mt-1 block w-full" value="{{ $pembelian->tgl_pengiriman }}" readonly>
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
