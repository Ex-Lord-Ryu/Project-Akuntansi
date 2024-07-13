<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Pengirim') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4">
        <div class="mt-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
            <form action="{{ route('pengirim.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="jenis" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jenis</label>
                    <input type="text" name="jenis" id="jenis" class="form-control mt-1 block w-full" required>
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
