<x-app-layout>
    <x-slot name="header">
        {{ __('Edit Supplier') }}
    </x-slot>
    <div class="container px-6 mx-auto grid">
        <form action="{{ route('supplier.update', $supplier->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                <div class="mt-4 relative">
                    <div class="relative">
                        <x-text-input placeholder=" " type="text" id="nama_supplier" name="nama_supplier" class="block w-full" value="{{ $supplier->nama_supplier }}" required autofocus />
                        <x-input-label for="nama_supplier" :value="__('Nama Supplier')" />
                    </div>
                    <div class="relative">
                        <x-input-error :messages="$errors->get('nama_supplier')" class="mt-2" />
                    </div>
                </div>
                <div class="mt-4 relative">
                    <div class="relative">
                        <x-text-input placeholder=" " type="number" id="no_hp" name="no_hp" class="block w-full" value="{{ $supplier->no_hp }}" required autofocus />
                        <x-input-label for="no_hp" :value="__('Nomor Telepon/HP')" />
                    </div>
                    <div class="relative">
                        <x-input-error :messages="$errors->get('no_hp')" class="mt-2" />
                    </div>
                </div>

                <div class="mt-4 card-footer">
                    <button type="submit" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">Tambah Data</button>
                    <button class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                        <a href="{{ route('supplier.index') }}" type="button">Kembali</a>
                    </button>
                </div>
            </div>
        </form>
    </div>

</x-app-layout>
