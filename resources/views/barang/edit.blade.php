<!-- resources/views/barang/edit.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Barang') }}
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
            <form action="{{ route('barang.update', $barang) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="nama" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama</label>
                    <input type="text" name="nama" id="nama" class="form-control mt-1 block w-full @error('nama') is-invalid @enderror" value="{{ old('nama', $barang->nama) }}" required>
                    @error('nama')
                        <div class="alert alert-danger mt-2 text-red-600">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="image" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Image</label>
                    <input type="file" name="image" id="image" class="form-control mt-1 block w-full @error('image') is-invalid @enderror">
                    @error('image')
                        <div class="alert alert-danger mt-2 text-red-600">{{ $message }}</div>
                    @enderror
                    @if ($barang->image)
                        <div class="mt-2">
                            <img src="{{ asset('storage/images/' . $barang->image) }}" alt="{{ $barang->nama }}" width="100">
                        </div>
                    @endif
                </div>
                <button type="submit" class="btn btn-success">Update</button>
            </form>
        </div>
    </div>
</x-app-layout>
