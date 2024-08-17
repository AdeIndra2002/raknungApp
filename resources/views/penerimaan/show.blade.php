<x-app-layout>
    <x-slot name="header">
        {{ __('Detail Penerimaan') }}
    </x-slot>

    <div class="container px-6 mx-auto grid">
        @csrf
        <div class="px-6 py-4 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
            <!-- Pengajuan ID -->
            <div class="mb-4 relative">
                <x-input-label for="pembelian_id" :value="__('Nama & Divisi Pengaju')" />
                <select name="pembelian_id" id="pembelian_id" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 dark:bg-gray-800 appearance-none dark:text-gray-400 dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" readonly>
                    <option value="">Pilih Nama Pengaju</option>
                    @foreach ($pembelian as $p)
                    <option value="{{ $p->id }}" {{ $p->id == old('pembelian_id', $penerimaan->pembelian_id) ? 'selected' : '' }}>{{ $p->pengajuan->nama_pengaju}} - {{ $p->pengajuan->divisi->nama_divisi }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('pembelian_id')" class="mt-2" />
            </div>

            <!-- Total Harga -->
            <div class="mb-4 relative">
                <input class="font-semibold block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-gray-400 dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" value="{{ $penerimaan->pembelian->total_harga }}" placeholder=" " type="text" id="pembelian_id" name="pembelian_id" class="block w-full" readonly />
                <x-input-label for="total_harga" :value="__('Total Harga')" />
            </div>

            <!-- Gambar penerimaan -->
            <div id="image-supplier-fields">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white mt-6" for="gambar">Gambar Pembelian</label>
                @foreach ($penerimaan->pembelian->GambarPembelian as $index => $gambar)
                <div class="image-supplier-row mb-4 relative" data-index="{{ $index }}">
                    @if($gambar->gambar)
                    <img src="{{ asset('storage/images/' . $gambar->gambar) }}" alt="Gambar Nota" class="mt-2 w-24 h-24 object-cover">
                    @endif
                </div>
                @endforeach
            </div>
            <!-- Gambar penerimaan -->
            <div id="image-supplier-fields">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white mt-6" for="gambar">Gambar Penerimaan</label>
                @foreach ($penerimaan->GambarPenerimaan as $index => $gambar)
                <div class="image-supplier-row mb-4 relative" data-index="{{ $index }}">
                    @if($gambar->gambar)
                    <img src="{{ asset('storage/images/' . $gambar->gambar) }}" alt="Gambar Nota" class="mt-2 w-24 h-24 object-cover">
                    @endif
                </div>
                @endforeach
            </div>

            <!-- Submit Button -->
            <div class="mt-4 flex space-x-2">
                <a href="{{ route('penerimaan.index') }}" class="flex items-center justify-center px-4 py-2 text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm text-center">Kembali</a>
                <a href="{{ route('penerimaan.generate', $penerimaan->id) }}" class="px-4 py-2 text-sm font-medium leading-5 text-white bg-green-600 rounded-lg hover:bg-green-700 focus:outline-none focus:shadow-outline-green flex items-center">
                    <!-- SVG Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 9h6v6H6zM15 9h6v6h-6zM6 15h6v6H6zM15 15h6v6h-6zM3 5a2 2 0 012-2h14a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2V5z" />
                    </svg>
                    Cetak Lampiran
                </a>

            </div>
        </div>
    </div>

</x-app-layout>
