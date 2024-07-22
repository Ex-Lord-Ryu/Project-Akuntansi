<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Warna') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4">
        <div class="mt-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
            <form action="{{ route('warna.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="warna" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Warna</label>
                    <input type="text" name="warna" id="warna" class="form-control mt-1 block w-full" required>
                </div>
                <div class="flex justify-end">
                    <a href="{{ route('warna.index') }}" class="btn btn-light mr-2">Cancel</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
