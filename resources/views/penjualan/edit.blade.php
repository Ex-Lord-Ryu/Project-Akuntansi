<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Penjualan') }}
        </h2>
    </x-slot>

    <link rel="stylesheet" href="{{ asset('assets/css/btn.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <div class="container mx-auto px-4 py-6">
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
            <form id="penjualan-form" action="{{ route('penjualan.update', $penjualan->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="id_pelanggan" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Pelanggan</label>
                    <div class="flex">
                        <select name="id_pelanggan" id="id_pelanggan" class="form-control mt-1 block w-full @error('id_pelanggan') is-invalid @enderror" required>
                            <option value="">Pilih Pelanggan</option>
                            @foreach ($pelanggans as $pelanggan)
                                <option value="{{ $pelanggan->id }}" {{ $penjualan->id_pelanggan == $pelanggan->id ? 'selected' : '' }}>
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
                    <input type="date" name="tgl_penjualan" id="tgl_penjualan" class="form-control mt-1 block w-full @error('tgl_penjualan') is-invalid @enderror" value="{{ $penjualan->tgl_penjualan }}" required>
                    @error('tgl_penjualan')
                        <div class="alert alert-danger mt-2 text-red-600">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="id_status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                    <select name="id_status" id="id_status" class="form-control mt-1 block w-full @error('id_status') is-invalid @enderror" required>
                        @foreach ($statuses as $status)
                            <option value="{{ $status->id }}" {{ $penjualan->id_status == $status->id ? 'selected' : '' }}>
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
                        <option value="">Pilih Pengirim</option>
                        @foreach ($pengirims as $pengirim)
                            <option value="{{ $pengirim->id }}" {{ $penjualan->id_pengirim == $pengirim->id ? 'selected' : '' }}>
                                {{ $pengirim->jenis }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_pengirim')
                        <div class="alert alert-danger mt-2 text-red-600">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="tgl_penerimaan" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal Penerimaan</label>
                    <input type="date" name="tgl_penerimaan" id="tgl_penerimaan" class="form-control mt-1 block w-full @error('tgl_penerimaan') is-invalid @enderror" value="{{ $penjualan->tgl_penerimaan }}" required>
                    @error('tgl_penerimaan')
                        <div class="alert alert-danger mt-2 text-red-600">{{ $message }}</div>
                    @enderror
                </div>

                <div id="items">
                    @foreach ($penjualan->penjualanItems as $index => $item)
                        <div class="item mb-4">
                            <input type="hidden" name="items[{{ $index }}][id]" value="{{ $item->id }}">
                            <input type="hidden" name="items[{{ $index }}][no_rangka]" value="{{ $item->no_rangka }}">
                            <input type="hidden" name="items[{{ $index }}][no_mesin]" value="{{ $item->no_mesin }}">
                            <div class="mb-4">
                                <label for="items[{{ $index }}][stok_id]" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Barang</label>
                                <input type="text" class="form-control mt-1 block w-full" value="{{ $item->stok->barang->nama }}" readonly>
                                <input type="hidden" name="items[{{ $index }}][stok_id]" value="{{ $item->id_stok }}">
                            </div>
                            <div class="mb-4">
                                <label for="items[{{ $index }}][warna]" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Warna</label>
                                <input type="text" name="items[{{ $index }}][warna]" class="form-control mt-1 block w-full" value="{{ $item->stok->warna->warna }}" readonly>
                            </div>
                            <div class="mb-4">
                                <label for="items[{{ $index }}][harga]" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Harga</label>
                                <input type="text" name="items[{{ $index }}][harga]" class="form-control mt-1 block w-full harga-input" value="{{ number_format($item->harga, 0, ',', '.') }}" required>
                            </div>
                            <div class="flex justify-end mb-4">
                                <button type="button" class="btn btn-danger remove-item">Hapus Item</button>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="flex justify-between items-center">
                    <a href="{{ route('penjualan.index') }}" class="btn btn-dark">Back</a>
                    <div class="flex space-x-2">
                        <button type="button" class="btn btn-primary" id="add-item">Tambah Item</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
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
                    <div class="row">
                        @foreach ($stokAvailable as $stok)
                            <div class="col-md-4 mb-4">
                                <div class="card">
                                    <img src="{{ asset('storage/' . $stok->barang->image) }}" class="card-img-top" alt="{{ $stok->barang->nama }}" onerror="this.onerror=null;this.src='{{ asset('assets/images/default.jpg') }}';">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $stok->barang->nama }}</h5>
                                        <p class="card-text">Warna: {{ $stok->warna->warna }}</p>
                                        <p class="card-text">Harga: {{ number_format($stok->harga, 0, ',', '.') }}</p>
                                        <button type="button" class="btn btn-primary select-item" data-id="{{ $stok->id }}" data-nama="{{ $stok->barang->nama }}" data-warna="{{ $stok->warna->warna }}" data-harga="{{ $stok->harga }}" data-no-rangka="{{ $stok->no_rangka }}" data-no-mesin="{{ $stok->no_mesin }}">Pilih</button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
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
    let itemIndex = {{ $penjualan->penjualanItems->count() }};

    document.getElementById('add-item').addEventListener('click', function() {
        $('#itemModal').modal('show');
    });

    $(document).on('click', '.select-item', function () {
        const itemId = $(this).data('id');
        const itemNama = $(this).data('nama');
        const itemWarna = $(this).data('warna');
        const itemHarga = $(this).data('harga');
        const itemNoRangka = $(this).data('no-rangka');
        const itemNoMesin = $(this).data('no-mesin');

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
                <input type="text" name="items[${itemIndex}][harga]" class="form-control mt-1 block w-full harga-input" value="${formatRupiah(itemHarga)}" required>
            </div>
            <div class="flex justify-end mb-4">
                <button type="button" class="btn btn-danger remove-item">Hapus Item</button>
            </div>
        `;
        itemsDiv.appendChild(newItem);
        itemIndex++;
        $('#itemModal').modal('hide');
    });

    $(document).on('click', '.remove-item', function () {
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
