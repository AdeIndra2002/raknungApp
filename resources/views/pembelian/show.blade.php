<x-app-layout>
    <x-slot name="header">
        {{ __('Detail Pembelian') }}
    </x-slot>

    <div class="container px-6 mx-auto grid">

        <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
            <!-- Nama Pengaju -->
            <div class="mb-4 relative">
                <x-input-label for="pengajuan_id" :value="__('Nama & Divisi Pengaju')" />
                <select name="pengajuan_id" id="pengajuan_id" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 dark:bg-gray-800 appearance-none dark:text-gray-400 dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" disabled>
                    <option value="">Pilih Nama Pengaju</option>
                    @foreach ($pengajuan as $pengajuan)
                    <option value="{{ $pengajuan->id }}" {{ $pengajuan->id == old('pengajuan_id', $pembelian->pengajuan_id) ? 'selected' : '' }}>{{ $pengajuan->nama_pengaju }} - {{ $pengajuan->divisi->nama_divisi }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('pengajuan_id')" class="mt-2" />
            </div>

            <!-- Total Harga -->
            <div class="mb-4 relative">
                <x-text-input placeholder=" " type="text" id="total_harga" name="total_harga" class="block w-full" value="{{ old('total_harga', $pembelian->total_harga) }}" required />
                <x-input-label for="total_harga" :value="__('Total Harga')" />
                <x-input-error :messages="$errors->get('total_harga')" class="mt-2" />
            </div>

            <!-- Barang & Jumlah Barang -->
            <div id="image-supplier-fields">
                @foreach ($pembelian->GambarPembelian as $index => $gambar)
                <div class="image-supplier-row mb-4 relative" data-index="{{ $index }}">
                    <input type="hidden" name="gambar_id[]" value="{{ $gambar->id }}"> <!-- Store gambar ID -->
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white mt-6" for="gambar_{{ $index }}">Gambar Nota</label>
                    @if($gambar->gambar)
                    <img src="{{ asset('storage/images/' . $gambar->gambar) }}" alt="Gambar Nota" class="mt-2 w-24 h-24 object-cover">
                    @endif
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white mt-4" for="supplier_{{ $index }}">Pilih Supplier</label>
                    <select name="supplier_id[]" id="supplier_{{ $index }}" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 dark:bg-gray-800 appearance-none dark:text-gray-400 dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" disabled>
                        <option value="">Pilih Nama Supplier</option>
                        @foreach ($supplier as $supp)
                        <option value="{{ $supp->id }}" {{ $supp->id == old('supplier_id.' . $index, $gambar->supplier_id) ? 'selected' : '' }}>{{ $supp->nama_supplier }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('supplier_id.' . $index)" class="mt-2" />
                </div>
                @endforeach
            </div>

            <div class="my-4">
                @if($pembelian->status === 'Gagal')
                <label for="note" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Catatan</label>
                <textarea value="{{ $pengajuan->note }}" id="note" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Tuliskan alasan anda..." name="note" disabled>{{ $pembelian->note }}</textarea>
                @endif
            </div>

            <!-- Buttons -->
            <div class="mt-4 card-footer">
                <a href="{{ route('pembelian.index') }}" class="px-4 py-2 text-sm font-medium leading-5 text-white bg-purple-600 rounded-lg hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">Kembali</a>
            </div>
        </div>
    </div>
</x-app-layout>
