<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Pengirim') }}
        </h2>
    </x-slot>

    <link rel="stylesheet" href="{{ asset('assets/css/btn.css') }}">

    <div class="container mx-auto px-4">
        <div class="mt-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
            <form action="{{ route('pengirim.update', $pengirim->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="jenis" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jenis</label>
                    <input type="text" name="jenis" id="jenis" class="form-control mt-1 block w-full" value="{{ $pengirim->jenis }}" required>
                </div>
                <div class="flex justify-between items-center">
                    <a href="{{ route('pengirim.index') }}" class="btn btn-dark">Back</a>
                    <div class="flex space-x-2">
                        <button type="submit" class="btn btn-success">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
