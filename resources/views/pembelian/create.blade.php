<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Pembelian') }}
        </h2>
    </x-slot>

    <link rel="stylesheet" href="{{ asset('assets/css/btn.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/card.css') }}">
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
            <form id="pembelian-form" action="{{ route('pembelian.storeWithItems') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="id_vendor" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Vendor</label>
                    <div class="flex">
                        <select name="id_vendor" id="id_vendor" class="form-control mt-1 block w-full @error('id_vendor') is-invalid @enderror" required>
                            <option value="">Pilih Vendor</option>
                            @foreach ($vendors as $vendor)
                                <option value="{{ $vendor->id }}" {{ old('id_vendor') == $vendor->id ? 'selected' : '' }}>
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
                    <label for="tgl_pembelian" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal Pembelian</label>
                    <input type="date" name="tgl_pembelian" id="tgl_pembelian" class="form-control mt-1 block w-full @error('tgl_pembelian') is-invalid @enderror" value="{{ old('tgl_pembelian', date('Y-m-d')) }}" required>
                    @error('tgl_pembelian')
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
                            <option value="{{ $pengirim->id }}" {{ old('id_pengirim') == $pengirim->id ? 'selected' : '' }}>
                                {{ $pengirim->jenis }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_pengirim')
                        <div class="alert alert-danger mt-2 text-red-600">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="tgl_pengiriman" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal Pengiriman</label>
                    <input type="date" name="tgl_pengiriman" id="tgl_pengiriman" class="form-control mt-1 block w-full @error('tgl_pengiriman') is-invalid @enderror" value="{{ old('tgl_pengiriman') }}">
                    @error('tgl_pengiriman')
                        <div class="alert alert-danger mt-2 text-red-600">{{ $message }}</div>
                    @enderror
                </div>

                <div id="items">
                    <div class="item mb-4">
                        <!-- Initially empty, items will be added here -->
                    </div>
                </div>

                <div class="flex justify-between items-center">
                    <button type="button" class="btn btn-primary" id="add-item">Tambah Item</button>
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
                    <div class="mb-4">
                        <input type="text" id="search-barang" class="form-control" placeholder="Cari barang...">
                    </div>
                    <div class="row" id="barang-list">
                        @foreach ($barangs as $barang)
                            <div class="col-md-4 mb-4">
                                <div class="card">
                                    <img src="{{ asset('storage/' . $barang->image) }}" class="card-img-top" alt="{{ $barang->nama }}" onerror="this.onerror=null;this.src='{{ asset('assets/images/default.jpg') }}';">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $barang->nama }}</h5>
                                    </div>
                                    <div class="card-footer">
                                        <button type="button" class="btn btn-primary select-item" data-id="{{ $barang->id }}" data-nama="{{ $barang->nama }}" data-harga="{{ $barang->harga }}">Pilih</button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Color Selection -->
    <div class="modal fade" id="warnaModal" tabindex="-1" role="dialog" aria-labelledby="warnaModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="warnaModalLabel">Pilih Warna</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ul class="list-group">
                        @foreach ($warnas as $warna)
                            <li class="list-group-item list-group-item-action select-warna" data-id="{{ $warna->id }}" data-warna="{{ $warna->warna }}">{{ $warna->warna }}</li>
                        @endforeach
                    </ul>
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
    let selectedItemIndex = null;

    document.getElementById('add-item').addEventListener('click', function() {
        $('#itemModal').modal('show');
    });

    document.addEventListener('DOMContentLoaded', function () {
        $(document).on('click', '.select-item', function () {
            const itemId = $(this).data('id');
            const itemNama = $(this).data('nama');
            const itemHarga = $(this).data('harga');

            const itemsDiv = document.getElementById('items');
            const newItem = document.createElement('div');
            newItem.classList.add('item', 'mb-4');
            newItem.innerHTML = `
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Barang</label>
                    <input type="text" class="form-control mt-1 block w-full" value="${itemNama}" readonly>
                    <input type="hidden" name="items[${itemIndex}][id_barang]" value="${itemId}">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Warna</label>
                    <div class="input-group">
                        <input type="text" name="items[${itemIndex}][warna]" class="form-control mt-1 block w-full warna-input" value="" readonly>
                        <input type="hidden" name="items[${itemIndex}][id_warna]" value="">
                        <div class="input-group-append">
                            <button type="button" class="btn btn-primary select-warna-button" data-index="${itemIndex}">Pilih Warna</button>
                        </div>
                    </div>
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

        $(document).on('click', '.select-warna-button', function () {
            selectedItemIndex = $(this).data('index');
            $('#warnaModal').modal('show');
        });

        $(document).on('click', '.select-warna', function () {
            const warna = $(this).data('warna');
            const idWarna = $(this).data('id');
            const index = selectedItemIndex;
            const warnaInput = document.querySelector(`input[name="items[${index}][warna]"]`);
            const idWarnaInput = document.querySelector(`input[name="items[${index}][id_warna]"]`);
            warnaInput.value = warna;
            idWarnaInput.value = idWarna;
            $('#warnaModal').modal('hide');
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

        // Search functionality
        document.getElementById('search-barang').addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const cards = document.querySelectorAll('#barang-list .col-md-4');

            cards.forEach(card => {
                const cardTitle = card.querySelector('.card-title').textContent.toLowerCase();
                if (cardTitle.includes(searchTerm)) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });
</script>

