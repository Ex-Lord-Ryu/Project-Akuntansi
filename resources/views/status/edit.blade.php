<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Status') }}
        </h2>
    </x-slot>

    <link rel="stylesheet" href="{{ asset('assets/css/btn.css') }}">

    <div class="container mx-auto px-4">
        <div class="mt-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
            <form action="{{ route('status.update', $status->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="nama_status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Status</label>
                    <input type="text" name="nama_status" id="nama_status" class="form-control mt-1 block w-full" value="{{ $status->nama_status }}" required>
                </div>
                <div class="flex justify-between items-center">
                    <a href="{{ route('status.index') }}" class="btn btn-dark">Back</a>
                    <div class="flex space-x-2">
                        <button type="submit" class="btn btn-success">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
