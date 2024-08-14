<!-- resources/views/pembelians/hapus-gambar.blade.php -->
<x-app-layout>
    <x-slot name="header">
        {{ __('Hapus Gambar Pembelian') }}
    </x-slot>

    <div class="container px-6 mx-auto grid">
        <!-- Tambahkan di atas form di hapus-gambar.blade.php -->
        @if(session('success'))
        <div class="bg-green-500 text-white p-2 rounded mb-4">
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="bg-red-500 text-white p-2 rounded mb-4">
            {{ session('error') }}
        </div>
        @endif


        <form action="{{ route('pembelian.update', $pembelian->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Existing Images -->
            <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                <div class="mt-4 relative">
                    <label class="block text-sm font-medium text-gray-900 dark:text-gray-500" for="existingImages">Gambar yang sudah ada</label>
                    <div class="mt-2 flex flex-wrap gap-4">
                        @forelse($pembelian->GambarPembelian as $gambar)
                        <div class="relative group">
                            <img src="{{ asset('storage/images/' . $gambar->gambar) }}" alt="Gambar" class="h-auto max-w-60 transition-all duration-300 group-hover:blur-sm">
                            <div class="absolute inset-0 flex items-center justify-center bg-opacity-5 group-hover:bg-opacity-20 transition-opacity duration-300">
                                <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-gambar-deletion-{{ $gambar->id }}')" class="flex items-center px-2 py-2 text-sm font-medium text-red-700 bg-white-700 rounded-lg dark:text-gray-500 hover:dark:text-red-700 focus:outline-none focus:shadow-outline-gray">
                                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <x-modal name="confirm-gambar-deletion-{{ $gambar->id }}" focusable>
                            <form method="post" action="{{ route('gambar.destroy', $gambar->id) }}" class="p-6">
                                @csrf
                                @method('delete')
                                <h2 class="text-lg font-medium text-gray-400">
                                    {{ __('Apakah anda yakin ingin menghapus data gambar ini?') }}
                                </h2>
                                <p class="mt-1 text-sm text-gray-500">
                                    {{ __('Sekali anda menghapusnya, maka data akan tehapus secara permanen. Silahkan klik tombol hapus untuk melanjutkan penghapusan data secara permanen.') }}
                                </p>
                                <div class="mt-6 flex justify-end">
                                    <x-secondary-button x-on:click="$dispatch('close')">
                                        {{ __('Kembali') }}
                                    </x-secondary-button>
                                    <x-danger-button class="ms-3">
                                        {{ __('Hapus') }}
                                    </x-danger-button>
                                </div>
                            </form>
                        </x-modal>
                        @empty
                        <p class="text-gray-500">Tidak ada gambar.</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Button Simpan -->
            <div class="mt-4">
                <button type="submit" class="px-4 py-2 text-sm font-medium leading-5 text-white bg-purple-600 rounded-lg hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">Simpan Pembelian</button>
                <a href="{{ route('pembelian.edit', $pembelian->id) }}" class="px-4 py-2.5 text-sm font-medium leading-5 text-white bg-purple-600 rounded-lg hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">Kembali</a>
            </div>
        </form>
    </div>
</x-app-layout>
