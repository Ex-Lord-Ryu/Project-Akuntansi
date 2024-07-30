<!-- resources/views/penjualan/create.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Pembelian') }}
        </h2>
    </x-slot>

    <link rel="stylesheet" href="{{ asset('assets/css/btn.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

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
            <form id="penjualan-form" action="{{ route('penjualan.storeWithItems') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="id_pelanggan" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Pelanggan</label>
                    <div class="flex">
                        <select name="id_pelanggan" id="id_pelanggan" class="form-control mt-1 block w-full @error('id_pelanggan') is-invalid @enderror" required>
                            <option value="">Pilih Pelanggan</option>
                            @foreach ($pelanggans as $pelanggan)
                                <option value="{{ $pelanggan->id }}" {{ old('id_pelanggan') == $pelanggan->id ? 'selected' : '' }}>
                                    {{ $pelanggan->nama }}
                                </option>
                            @endforeach
                        </select>
                        <a href="{{ route('pelanggan.createFromPenjualan') }}" class="btn btn-primary ml-2 mt-1">Tambah Pelanggan</a>
                    </div>
                    @error('id_pelanggan')
                        <div class="alert alert-danger mt-2 text-red-600">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="tgl_penjualan" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal Penjualan</label>
                    <input type="date" name="tgl_penjualan" id="tgl_penjualan" class="form-control mt-1 block w-full @error('tgl_penjualan') is-invalid @enderror" value="{{ old('tgl_penjualan', date('Y-m-d')) }}" required>
                    @error('tgl_penjualan')
                        <div class="alert alert-danger mt-2 text-red-600">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4" hidden>
                    <select name="id_status" id="id_status" class="form-control mt-1 block w-full @error('id_status') is-invalid @enderror" required>
                        @foreach ($statuses as $status)
                            <option value="{{ $status->id }}" {{ old('id_status') == $status->id ? 'selected' : '' }}>
                                {{ $status->nama_status }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_status')
                        <div class="alert alert-danger mt-2 text-red-600">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="id_pengirim" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Pengirim</label>
                    <select name="id_pengirim" id="id_pengirim" class="form-control mt-1 block w-full @error('id_pengirim') is-invalid @enderror">
                        @foreach ($pengirims as $pengirim)
                            <option value="{{ $pengirim->id }}" {{ old('id_pengirim') == $pengirim->id ? 'selected' : ($pengirim->jenis == 'pick up' ? 'selected' : '') }}>
                                {{ $pengirim->jenis }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_pengirim')
                        <div class="alert alert-danger mt-2 text-red-600">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="tgl_penerimaan" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal Pengiriman</label>
                    <input type="date" name="tgl_penerimaan" id="tgl_penerimaan" class="form-control mt-1 block w-full @error('tgl_penerimaan') is-invalid @enderror" value="{{ old('tgl_penerimaan') }}" required>
                    @error('tgl_penerimaan')
                        <div class="alert alert-danger mt-2 text-red-600">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Stock and Color Selection Form -->
                <div class="mb-4">
                    <label for="stok" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Pilih Barang</label>
                    <select id="stok" class="form-control mt-1 block w-full" required>
                        <option value="">Pilih Barang</option>
                        @foreach ($stokGrouped as $barangNama => $stoks)
                            <option value="{{ $barangNama }}" {{ isset($selectedBarang) && $selectedBarang->barang->nama == $barangNama ? 'selected' : '' }}>
                                {{ $barangNama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4" id="warna-div" style="{{ isset($selectedWarna) ? 'display: block;' : 'display: none;' }}">
                    <label for="warna" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Pilih Warna</label>
                    <select id="warna" class="form-control mt-1 block w-full" required>
                        <option value="">Pilih Warna</option>
                        @if(isset($selectedBarang))
                            @foreach($stokGrouped[$selectedBarang->barang->nama] as $stok)
                                <option value="{{ $stok->warna->warna }}" data-id="{{ $stok->id }}" data-nama="{{ $stok->barang->nama }}" data-warna="{{ $stok->warna->warna }}" data-harga="{{ $stok->harga }}" data-no-rangka="{{ $stok->no_rangka }}" data-no-mesin="{{ $stok->no_mesin }}" {{ isset($selectedWarna) && $selectedWarna->warna->warna == $stok->warna->warna ? 'selected' : '' }}>
                                    {{ $stok->warna->warna }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                </div>

                <div id="items">
                    <div class="item mb-4">
                        <!-- Initially empty, items will be added here -->
                    </div>
                </div>

                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Pilih barang yang ingin ditambahkan</label>
                <div class="flex justify-between items-center">
                    <button type="button" class="btn btn-primary" id="add-item" {{ isset($selectedWarna) ? '' : 'disabled' }}>Tambah Item</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal for Item Selection -->
    <div class="modal fade" id="itemModal" tabindex="-1" role="dialog" aria-labelledby="itemModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="itemModalLabel">Pilih Barang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row" id="item-cards">
                        <!-- Cards will be inserted here based on selection -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    let itemIndex = 0;

    // Populate colors based on selected stock item
    document.getElementById('stok').addEventListener('change', function() {
        const selectedStock = this.value;
        const warnaDiv = document.getElementById('warna-div');
        const warnaSelect = document.getElementById('warna');

        if (selectedStock) {
            warnaDiv.style.display = 'block';
            warnaSelect.innerHTML = '<option value="">Pilih Warna</option>';

            @foreach ($stokGrouped as $barangNama => $stoks)
                if (selectedStock === "{{ $barangNama }}") {
                    @foreach ($stoks as $stok)
                        warnaSelect.innerHTML +=
                            `<option value="{{ $stok->warna->warna }}" data-id="{{ $stok->id }}" data-nama="{{ $stok->barang->nama }}" data-warna="{{ $stok->warna->warna }}" data-harga="{{ $stok->harga }}" data-no-rangka="{{ $stok->no_rangka }}" data-no-mesin="{{ $stok->no_mesin }}">{{ $stok->warna->warna }}</option>`;
                    @endforeach
                }
            @endforeach
        } else {
            warnaDiv.style.display = 'none';
            document.getElementById('add-item').disabled = true;
        }
    });

    // Enable the add item button when a color is selected
    document.getElementById('warna').addEventListener('change', function() {
        const selectedWarna = this.value;
        if (selectedWarna) {
            document.getElementById('add-item').disabled = false;
        } else {
            document.getElementById('add-item').disabled = true;
        }
    });

    document.getElementById('add-item').addEventListener('click', function() {
        const selectedWarnaOption = document.querySelector('#warna option:checked');
        const itemId = selectedWarnaOption.getAttribute('data-id');
        const itemNama = selectedWarnaOption.getAttribute('data-nama');
        const itemWarna = selectedWarnaOption.getAttribute('data-warna');
        const itemHarga = selectedWarnaOption.getAttribute('data-harga').toString();
        const itemNoRangka = selectedWarnaOption.getAttribute('data-no-rangka');
        const itemNoMesin = selectedWarnaOption.getAttribute('data-no-mesin');

        const itemsDiv = document.getElementById('items');
        const newItem = document.createElement('div');
        newItem.classList.add('item', 'mb-4');
        newItem.innerHTML = `
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Barang</label>
                <input type="text" class="form-control mt-1 block w-full" value="${itemNama}" readonly>
                <input type="hidden" name="items[${itemIndex}][stok_id]" value="${itemId}">
                <input type="hidden" name="items[${itemIndex}][no_rangka]" value="${itemNoRangka}">
                <input type="hidden" name="items[${itemIndex}][no_mesin]" value="${itemNoMesin}">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Warna</label>
                <input type="text" class="form-control mt-1 block w-full" value="${itemWarna}" readonly>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Harga</label>
                <input type="text" name="items[${itemIndex}][harga]" class="form-control mt-1 block w-full harga-input" value="${formatRupiah(itemHarga)}" readonly required>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Metode Pembayaran</label>
                <select name="items[${itemIndex}][metode_pembayaran]" class="form-control mt-1 block w-full" required>
                    <option value="cash">Cash</option>
                    <option value="credit">Credit</option>
                </select>
            </div>
            <div class="flex justify-end mb-4">
                <button type="button" class="btn btn-danger remove-item">Hapus Item</button>
            </div>
        `;
        itemsDiv.appendChild(newItem);
        itemIndex++;
        $('#itemModal').modal('hide');
    });

    $(document).on('click', '.remove-item', function() {
        $(this).closest('.item').remove();
    });

    document.getElementById('penjualan-form').addEventListener('submit', function(event) {
        const tglPenjualan = document.getElementById('tgl_penjualan').value;
        const tglPenerimaan = document.getElementById('tgl_penerimaan').value;

        if (tglPenerimaan && tglPenerimaan < tglPenjualan) {
            event.preventDefault();
            alert('Tanggal Penerimaan tidak boleh sebelum Tanggal Penjualan.');
        }

        // Convert formatted prices to integers
        const hargaInputs = document.querySelectorAll('.harga-input');
        hargaInputs.forEach(input => {
            input.value = parseInt(input.value.replace(/[^0-9]/g, ''), 10);
        });
    });

    document.addEventListener('input', function(e) {
        if (e.target && e.target.classList.contains('harga-input')) {
            e.target.value = formatRupiah(e.target.value);
        }
    });

    function formatRupiah(value) {
        let number_string = value.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            let separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return 'Rp. ' + rupiah;
    }
</script>
