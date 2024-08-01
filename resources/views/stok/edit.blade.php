<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Stok') }}
        </h2>
    </x-slot>

    <link rel="stylesheet" href="{{ asset('assets/css/btn.css') }}">

    <div class="container mx-auto px-4">
        <div class="mt-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form id="edit-stok-form" action="{{ route('stok.update', $stok->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="id_barang" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Barang</label>
                    <select name="id_barang" id="id_barang" class="form-control mt-1 block w-full">
                        @foreach ($barangs as $barang)
                            <option value="{{ $barang->id }}" {{ $stok->id_barang == $barang->id ? 'selected' : '' }}>
                                {{ $barang->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="id_warna" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Warna</label>
                    <select name="id_warna" id="id_warna" class="form-control mt-1 block w-full">
                        <option value="">Pilih Warna</option>
                        @foreach ($warnas as $warna)
                            <option value="{{ $warna->id }}" {{ $stok->id_warna == $warna->id ? 'selected' : '' }}>
                                {{ $warna->warna }}
                            </option>
                        @endforeach
                    </select>
                </div>
                {{-- <div class="mb-4">
                    <label for="tgl_penerimaan" class="block text-sm font-medium text-gray-700">Tanggal Penerimaan</label>
                    <input type="date" name="tgl_penerimaan" id="tgl_penerimaan" class="form-input mt-1 block w-full"
                        required>
                </div> --}}
                <div class="mb-4">
                    <label for="no_rangka" class="block text-sm font-medium text-gray-700 dark:text-gray-300">No Rangka</label>
                    <input type="text" name="no_rangka" id="no_rangka" value="{{ old('no_rangka', $stok->no_rangka) }}" minlength="17" class="form-control mt-1 block w-full" required>
                    @error('no_rangka')
                        <div class="text-red-600 mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="no_mesin" class="block text-sm font-medium text-gray-700 dark:text-gray-300">No Mesin</label>
                    <input type="text" name="no_mesin" id="no_mesin" value="{{ old('no_mesin', $stok->no_mesin) }}" minlength="17"  class="form-control mt-1 block w-full" required>
                    @error('no_mesin')
                        <div class="text-red-600 mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="harga" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Harga</label>
                    <input type="text" name="harga" id="harga" value="{{ old('harga', number_format($stok->harga, 0, ',', '.')) }}" class="form-control mt-1 block w-full" required>
                </div>
                <div class="flex justify-end">
                    <a href="{{ route('stok.index') }}" class="btn btn-light mr-2">Cancel</a>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function formatRupiah(value) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(value).replace(/\u00a0/g, '');
        }

        function parseRupiah(value) {
            return parseInt(value.replace(/[^,\d]/g, '').toString());
        }

        document.getElementById('harga').addEventListener('input', function (e) {
            let value = e.target.value.replace(/\D/g, '');
            e.target.value = formatRupiah(value);
        });

        document.getElementById('edit-stok-form').addEventListener('submit', function (event) {
            const noRangka = document.getElementById('no_rangka').value;
            const noMesin = document.getElementById('no_mesin').value;

            if (noRangka.length < 17) {
                alert('No Rangka harus memiliki panjang minimal 17 karakter.');
                event.preventDefault();
            }

            if (noMesin.length < 17) {
                alert('No Mesin harus memiliki panjang minimal 17 karakter.');
                event.preventDefault();
            }

            const hargaField = document.getElementById('harga');
            hargaField.value = parseRupiah(hargaField.value);
        });
    </script>
</x-app-layout>
