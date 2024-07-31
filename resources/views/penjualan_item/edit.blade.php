<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Penjualan Item') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4">
        <div class="mt-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
            <form method="POST" action="{{ route('penjualan_item.update', $penjualanItem->id) }}">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <x-input-label for="id_penjualan" :value="__('ID Penjualan')" />
                    <x-select-input id="id_penjualan" name="id_penjualan" class="block mt-1 w-full" required>
                        @foreach ($penjualans as $penjualan)
                            <option value="{{ $penjualan->id }}" {{ $penjualan->id == $penjualanItem->id_penjualan ? 'selected' : '' }}>
                                {{ $penjualan->id }} - {{ $penjualan->pelanggan->nama }}
                            </option>
                        @endforeach
                    </x-select-input>
                </div>

                <div class="mb-4">
                    <x-input-label for="id_barang" :value="__('Barang')" />
                    <x-select-input id="id_barang" name="id_barang" class="block mt-1 w-full" required>
                        @foreach ($barangs as $barang)
                            <option value="{{ $barang->id }}" {{ $barang->id == $penjualanItem->id_barang ? 'selected' : '' }}>
                                {{ $barang->nama }}
                            </option>
                        @endforeach
                    </x-select-input>
                </div>

                <div class="mb-4">
                    <x-input-label for="id_stok" :value="__('Stok')" />
                    <x-select-input id="id_stok" name="id_stok" class="block mt-1 w-full" required>
                        @foreach ($stoks as $stok)
                            <option value="{{ $stok->id }}" {{ $stok->id == $penjualanItem->id_stok ? 'selected' : '' }}>
                                {{ $stok->no_rangka }} - {{ $stok->no_mesin }}
                            </option>
                        @endforeach
                    </x-select-input>
                </div>

                <div class="mb-4">
                    <x-input-label for="id_warna" :value="__('Warna')" />
                    <x-select-input id="id_warna" name="id_warna" class="block mt-1 w-full">
                        @foreach ($stoks as $stok)
                            <option value="{{ $stok->id }}" {{ $stok->id == $penjualanItem->id_warna ? 'selected' : '' }}>
                                {{ $stok->warna->warna }}
                            </option>
                        @endforeach
                    </x-select-input>
                </div>

                <div class="mb-4">
                    <x-input-label for="no_rangka" :value="__('No Rangka')" />
                    <x-text-input id="no_rangka" name="no_rangka" type="text" class="mt-1 block w-full" value="{{ $penjualanItem->no_rangka }}" required />
                </div>

                <div class="mb-4">
                    <x-input-label for="no_mesin" :value="__('No Mesin')" />
                    <x-text-input id="no_mesin" name="no_mesin" type="text" class="mt-1 block w-full" value="{{ $penjualanItem->no_mesin }}" required />
                </div>

                <div class="mb-4">
                    <x-input-label for="harga" :value="__('Harga')" />
                    <x-text-input id="harga" name="harga" type="number" class="mt-1 block w-full" value="{{ $penjualanItem->harga }}" required />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-primary-button class="ml-4">
                        {{ __('Update') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
