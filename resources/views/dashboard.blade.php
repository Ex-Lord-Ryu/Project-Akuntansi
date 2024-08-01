<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <link rel="stylesheet" href="{{ asset('assets/css/btn.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
        .card {
            height: 100%;
            display: flex;
            flex-direction: column;
            cursor: pointer;
        }

        .card-img-top {
            height: 200px;
            object-fit: cover;
        }

        .card-body {
            flex: 1;
        }
    </style>

    <div class="container mx-auto px-4 py-6">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="mt-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
            <h3 class="text-lg font-medium text-gray-800 dark:text-gray-200">Available Stock</h3>
            <div class="row">
                @foreach ($stokGrouped as $barangNama => $data)
                    @if ($data['latestPrice'] != 0)
                        <div class="col-md-4 mb-4">
                            @php $item = $data['items']->first(); @endphp
                            <div class="card">
                                <img src="{{ asset('storage/' . $item->barang->image) }}" class="card-img-top"
                                    alt="{{ $barangNama }}"
                                    onerror="this.onerror=null;this.src='{{ asset('assets/images/default.jpg') }}';">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $barangNama }}</h5>
                                    <p class="card-text">Warna: {{ $data['colors'] }}</p>
                                    <p class="card-text">
                                        Harga:
                                        {{ 'Rp' . number_format($data['latestPrice'], 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
