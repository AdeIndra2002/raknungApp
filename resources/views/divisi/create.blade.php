<x-app-layout>
    <x-slot name="header">
        {{ __('Tambah Divisi') }}
    </x-slot>
    <div class="container px-6 mx-auto grid">
        <form action="{{ route('divisi.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                <div class="relative">
                    <div class="relative">
                        <x-text-input placeholder=" " type="text" id="nama_divisi" name="nama_divisi" class="block w-full" value="{{ old('nama_divisi') }}" required autofocus />
                        <x-input-label for="nama_divisi" :value="__('Nama Sub Divisi')" />
                    </div>
                    <div class="relative">
                        <x-input-error :messages="$errors->get('nama_divisi')" class="mt-2" />
                    </div>
                </div>

                <div class="mt-4 card-footer">
                    <button type="submit" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">Tambah Data</button>
                    <button class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                        <a href="{{ route('divisi.index') }}" type="button">Kembali</a>
                    </button>
                </div>

            </div>


        </form>
    </div>

</x-app-layout>
