<x-app-layout>
    <x-slot name="header">
        {{ __('Detail Pengajuan') }}
    </x-slot>

    <div class="container px-6 mx-auto grid">
        <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
            <!-- Nama Pengajuan -->
            <div class="relative">
                <x-input-label for="nama_pengaju" :value="__('Nama Pengajuan')" />
                <x-text-input type="text" id="nama_pengaju" name="nama_pengaju" class="block w-full" value="{{ $pengajuan->nama_pengaju }}" disabled />
            </div>

            <!-- Tanggal Pengajuan -->
            <div class="mt-4 relative">
                <x-input-label for="tanggal_pengajuan" :value="__('Tanggal Pengajuan')" />
                <x-text-input type="date" id="tanggal_pengajuan" name="tanggal_pengajuan" class="block w-full" value="{{ $pengajuan->tanggal_pengajuan }}" disabled />
            </div>

            <!-- Nama & Jumlah Barang -->
            <div class="mt-4 relative">
                @foreach($pengajuan->pengajuanBarang as $index => $pBarang)
                <div class="flex space-x-2 mt-2 relative">
                    <!-- Nama Barang -->
                    <select class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 dark:bg-gray-800 appearance-none dark:text-gray-400 dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" disabled>
                        <option value="{{ $pBarang->pengajuan_id }}" {{ $pBarang->id == $pBarang->barang_id ? 'selected' : '' }}>{{ $pBarang->barang->barang }}</option>
                    </select>
                    <x-input-label for="barangId" :value="__('Nama & Jumlah Barang')" />
                    <!-- Jumlah -->
                    <div class="relative">
                        <x-text-input type="number" id="jumlah" name="jumlah[]" class="block w-full" value="{{ old('jumlah.' . $index, $pBarang->jumlah) }}" disabled />
                        <x-input-label for="jumlah" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-800 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Jumlah</x-input-label>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Divisi Pengaju -->
            <div class="mt-4 relative">
                <x-input-label for="nama_divisi" :value="__('Divisi Pengaju')" />
                <x-text-input type="text" id="nama_divisi" name="nama_divisi" class="block w-full" value="{{ $pengajuan->divisi->nama_divisi }}" disabled />
            </div>

            <div class="my-4">
                @if($pengajuan->status === 'Ditolak')
                <label for="note" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Catatan</label>
                <textarea value="{{ $pengajuan->note }}" id="note" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Tuliskan alasan anda..." name="note" disabled>{{ $pengajuan->note }}</textarea>
                @endif
            </div>
            <!-- Button Kembali dan Cetak Surat -->
            <div class="mt-4 card-footer flex space-x-4">
                <a href="{{ route('pengajuan.index') }}" class="px-4 py-2 text-sm font-medium leading-5 text-white bg-purple-600 rounded-lg hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">Kembali</a>

                <!-- Conditionally display the "Cetak Surat" button -->
                @if($pengajuan->status === 'Diterima')
                <a href="{{ route('pengajuan.generate', $pengajuan->id) }}" class="px-4 py-2 text-sm font-medium leading-5 text-white bg-green-600 rounded-lg hover:bg-green-700 focus:outline-none focus:shadow-outline-green flex items-center">
                    <!-- SVG Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 9h6v6H6zM15 9h6v6h-6zM6 15h6v6H6zM15 15h6v6h-6zM3 5a2 2 0 012-2h14a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2V5z" />
                    </svg>
                    Cetak Surat
                </a>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
