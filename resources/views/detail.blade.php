<!-- resources/views/detail.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detail Barang') }}
        </h2>
    </x-slot>

    <link rel="stylesheet" href="{{ asset('assets/css/btn.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
        .border-custom {
            border-color: #737476;
            border: 1px solid;
            padding: 8px 16px;
            border-radius: 4px;
        }

        .btn-action {
            width: 100px;
            /* Set the desired width */
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
            <div class="row">
                <div class="col-md-6">
                    <img src="{{ asset('storage/' . $barang->image) }}" class="img-fluid" alt="{{ $barang->nama }}"
                        onerror="this.onerror=null;this.src='{{ asset('assets/images/default.jpg') }}';">
                </div>
                <div class="col-md-6">
                    <h3 class="text-lg font-medium text-gray-800 dark:text-gray-200">{{ $barang->nama }}</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Warna: 
                        <select id="warnaSelect" class="form-control">
                            @foreach($stok as $item)
                                <option value="{{ $item->id }}">{{ $item->warna->warna }}</option>
                            @endforeach
                        </select>
                    </p>
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        Harga:
                        @if ($latestPrice == 0)
                            -
                        @else
                            {{ 'Rp' . number_format($latestPrice, 0, ',', '.') }}
                        @endif
                    </p>
                    <div class="mt-6 flex justify-end">
                        <a href="{{ route('dashboard') }}" class="btn btn-light border-custom ml-2">Kembali</a>
                        <button id="buyButton" class="btn btn-primary ml-2">Beli</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>