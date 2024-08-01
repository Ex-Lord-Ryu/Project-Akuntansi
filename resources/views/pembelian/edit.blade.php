<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Pembelian') }}
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
            <form id="pembelian-form" action="{{ route('pembelian.update', $pembelian->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="id_pengirim" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Pengirim</label>
                    <select name="id_pengirim" id="id_pengirim" class="form-control mt-1 block w-full" readonly>
                        @foreach ($pengirims as $pengirim)
                            <option value="{{ $pengirim->id }}" {{ $pembelian->id_pengirim == $pengirim->id ? 'selected' : '' }}>
                                {{ $pengirim->jenis }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div id="items">
                    @foreach ($pembelian->items as $index => $item)
                        <div class="item mb-4">
                            <input type="hidden" name="items[{{ $index }}][id]" value="{{ $item->id }}">
                            <div class="mb-4">
                                <label for="items[{{ $index }}][id_barang]" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Barang</label>
                                <select name="items[{{ $index }}][id_barang]" id="items[{{ $index }}][id_barang]" class="form-control mt-1 block w-full" required>
                                    @foreach ($barangs as $barang)
                                        <option value="{{ $barang->id }}" {{ $item->id_barang == $barang->id ? 'selected' : '' }}>
                                            {{ $barang->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="items[{{ $index }}][id_warna]" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Warna</label>
                                <select name="items[{{ $index }}][id_warna]" id="items[{{ $index }}][id_warna]" class="form-control mt-1 block w-full">
                                    <option value="">Pilih Warna</option>
                                    @foreach ($warnas as $warna)
                                        <option value="{{ $warna->id }}" {{ $item->id_warna == $warna->id ? 'selected' : '' }}>
                                            {{ $warna->warna }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="items[{{ $index }}][harga]" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Harga</label>
                                <input type="text" name="items[{{ $index }}][harga]" id="items[{{ $index }}][harga]" class="form-control mt-1 block w-full harga-input" required value="{{ number_format($item->harga, 0, ',', '.') }}">
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
    let itemIndex = {{ $pembelian->items->count() }};
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
                        <input type="hidden" name="items[${itemIndex}][id_warna]" class="warna-id-input">
                        <input type="text" name="items[${itemIndex}][warna]" class="form-control mt-1 block w-full warna-input" value="" readonly>
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
            const warnaId = $(this).data('id');
            const index = selectedItemIndex;
            const warnaInput = document.querySelector(`input[name="items[${index}][warna]"]`);
            const warnaIdInput = document.querySelector(`input[name="items[${index}][id_warna]"]`);
            if (warnaInput && warnaIdInput) {
                warnaInput.value = warna;
                warnaIdInput.value = warnaId;
                $('#warnaModal').modal('hide');
            } else {
                console.error('Warna input not found for index:', index);
            }
        });

        document.getElementById('items').addEventListener('click', function(e) {
            if (e.target && e.target.classList.contains('remove-item')) {
                e.target.closest('.item').remove();
            }
        });

        document.getElementById('pembelian-form').addEventListener('submit', function(event) {
            const tglPembelian = document.getElementById('tgl_pembelian');
            const tglPengiriman = document.getElementById('tgl_pengiriman');

            if (tglPengiriman && tglPengiriman.value && tglPengiriman.value < tglPembelian.value) {
                event.preventDefault();
                alert('Tanggal Pengiriman tidak boleh sebelum Tanggal Pembelian.');
                return;
            }

            // Convert formatted prices to integers
            const hargaInputs = document.querySelectorAll('.harga-input');
            let allValid = true;
            hargaInputs.forEach(input => {
                const originalValue = input.value;
                const intValue = parseInt(input.value.replace(/[^0-9]/g, ''), 10);
                console.log('Before conversion:', originalValue); // Log before conversion
                console.log('After conversion:', intValue); // Log after conversion
                input.value = intValue;

                // Check if conversion was successful
                if (isNaN(intValue)) {
                    alert('Invalid price value: ' + originalValue);
                    allValid = false;
                }
            });

            // If any value is invalid, prevent form submission
            if (!allValid) {
                event.preventDefault();
            }
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
        const searchBarang = document.getElementById('search-barang');
        if (searchBarang) {
            searchBarang.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                const cards = document.querySelectorAll('#barang-list .col-md-4');

                cards.forEach(card => {
                    const cardTitle = card.querySelector('.card-title');
                    if (cardTitle && cardTitle.textContent.toLowerCase().includes(searchTerm)) {
                        card.style.display = '';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        } else {
            console.error('Search bar element not found');
        }
    });
</script>
