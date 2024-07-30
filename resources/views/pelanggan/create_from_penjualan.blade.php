<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Pelanggan') }}
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
            <form action="{{ route('pelanggan.storeFromPenjualan') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="nama" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama</label>
                    <input type="text" name="nama" id="nama" class="form-control mt-1 block w-full" required>
                </div>
                <div class="mb-4">
                    <label for="alamat" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Alamat</label>
                    <input type="text" name="alamat" id="alamat" class="form-control mt-1 block w-full" required>
                </div>
                <div class="mb-4">
                    <label for="tgl_lahir" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal Lahir</label>
                    <input type="date" name="tgl_lahir" id="tgl_lahir" class="form-control mt-1 block w-full" required>
                </div>
                <div class="mb-4">
                    <label for="no_hp" class="block text-sm font-medium text-gray-700 dark:text-gray-300">No HP</label>
                    <input type="number" name="no_hp" id="no_hp" class="form-control mt-1 block w-full">
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                    <input type="email" name="email" id="email" class="form-control mt-1 block w-full">
                </div>
                <div class="mb-4">
                    <label for="wilayah" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Wilayah</label>
                    <input type="text" name="wilayah" id="wilayah" class="form-control mt-1 block w-full" required>
                </div>
                <div class="mb-4">
                    <label for="provinsi" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Provinsi</label>
                    <input type="text" name="provinsi" id="provinsi" class="form-control mt-1 block w-full" required>
                </div>
                <div class="flex justify-between items-center">
                    <a href="{{ route('penjualan.create') }}" class="btn btn-dark">Back</a>
                    <div class="flex space-x-2">
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
