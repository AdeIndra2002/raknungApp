<x-app-layout>
    <x-slot name="header">
        {{ __('Tambah Barang') }}
    </x-slot>
    <div class="container px-6 mx-auto grid">
        <form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                <div class="mt-4 relative">
                    <div class="relative">
                        <x-text-input placeholder=" " type="text" id="barang" name="barang" class="block w-full" value="{{ old('barang') }}" required autofocus />
                        <x-input-label for="barang" :value="__('Nama Barang')" />
                    </div>
                    <div class="relative">
                        <x-input-error :messages="$errors->get('barang')" class="mt-2" />
                    </div>
                </div>
                <div class="mt-4 relative">
                    <div class="relative">
                        <x-text-input placeholder=" " type="number" id="stok" name="stok" class="block w-full" value="{{ old('stok') }}" required autofocus />
                        <x-input-label for="stok" :value="__('Jumlah Stok')" />
                    </div>
                    <div class="relative">
                        <x-input-error :messages="$errors->get('stok')" class="mt-2" />
                    </div>
                </div>
                <div class="mt-4 relative">
                    <div class="relative">
                        <x-input-label for="kategori_id" :value="__('Pilih Kategori')" />
                        <select name="kategori_id" id="kategori_id" class=" block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 dark:bg-gray-800 appearance-none dark:text-gray-400 dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" required>
                            <option value="">Pilih Kategori</option>
                            @foreach($kategoris as $kategori)
                            <option value="{{ $kategori->id }}">{{ $kategori->kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="relative">
                        <x-input-error :messages="$errors->get('kategori_id')" class="mt-2" />
                    </div>
                </div>


                <div class="mt-4 card-footer">
                    <button type="submit" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">Tambah Data</button>
                    <button class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                        <a href="{{ route('barang.index') }}" type="button">Kembali</a>
                    </button>
                </div>

            </div>


        </form>
    </div>

</x-app-layout>
