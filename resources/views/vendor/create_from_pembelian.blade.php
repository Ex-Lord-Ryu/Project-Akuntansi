<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Vendor') }}
        </h2>
    </x-slot>

    <link rel="stylesheet" href="{{ asset('assets/css/btn.css') }}">

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
            <form action="{{ route('vendor.storeFromPembelian') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="nama" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama</label>
                    <input type="text" name="nama" id="nama" class="form-control mt-1 block w-full" required>
                </div>
                <div class="mb-4">
                    <label for="alamat" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Alamat</label>
                    <input type="text" name="alamat" id="alamat" class="form-control mt-1 block w-full" required>
                </div>
                <div class="flex justify-between items-center">
                    <a href="{{ route('pembelian.create') }}" class="btn btn-dark">Back</a>
                    <div class="flex space-x-2">
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
