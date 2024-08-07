<x-app-layout>
    <x-slot name="header">
        {{ __('Edit Pengajuan') }}
    </x-slot>

    <div class="container px-6 mx-auto grid">
        <form action="{{ route('pengajuan.update', $pengajuan->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                <!-- Nama Pengaju -->
                <div class="relative">
                    <x-text-input placeholder=" " type="text" id="nama_pengaju" name="nama_pengaju" class="block w-full" value="{{ old('nama_pengaju', $pengajuan->nama_pengaju) }}" required autofocus />
                    <x-input-label for="nama_pengaju" :value="__('Nama Pengaju')" />
                    <x-input-error :messages="$errors->get('nama_pengaju')" class="mt-2" />
                </div>

                <!-- Tanggal Pengajuan -->
                <div class="mt-4 relative">
                    <x-text-input placeholder=" " type="date" id="tanggal_pengajuan" name="tanggal_pengajuan" class="block w-full" value="{{ old('tanggal_pengajuan', $pengajuan->tanggal_pengajuan) }}" required />
                    <x-input-label for="tanggal_pengajuan" :value="__('Tanggal Pengajuan')" />
                    <x-input-error :messages="$errors->get('tanggal_pengajuan')" class="mt-2" />
                </div>

                <!-- Barang & Jumlah Barang -->
                <div class="mt-4 relative" id="barang-container">
                    @foreach ($pengajuan->pengajuanBarang as $index => $pBarang)
                    <div class="flex space-x-2 mt-2 relative barang-row" id="barang-row-{{ $index }}">
                        <select name="barang_id[]" id="barang_id_{{ $index }}" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 dark:bg-gray-800 appearance-none dark:text-gray-400 dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" required>
                            <option value="">Pilih Barang</option>
                            @foreach($barang ?? [] as $brg)
                            <option value="{{ $brg->id }}" {{ $brg->id == $pBarang->barang_id ? 'selected' : '' }}>{{ $brg->barang }}</option>
                            @endforeach
                        </select>
                        <x-input-label for="barang_id_{{ $index }}" :value="__('Nama & Jumlah Barang')" />
                        <div class="relative">
                            <x-text-input type="number" id="jumlah_{{ $index }}" name="jumlah[]" class="block w-full" placeholder=" " value="{{ old('jumlah.' . $index, $pBarang->jumlah) }}" required />
                            <x-input-label for="jumlah_{{ $index }}" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-800 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Jumlah</x-input-label>
                        </div>
                        <button type="button" class="btn-remove-barang flex items-center px-2 py-2 text-sm font-medium text-red-700 bg-white-700 rounded-lg dark:text-gray-500 hover:dark:text-red-700 focus:outline-none focus:shadow-outline-gray">
                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>
                    @endforeach
                    <x-input-error :messages="$errors->get('barang_id')" class="mt-2" />
                </div>
                <button type="button" class="mt-4 px-4 py-2 text-sm font-medium leading-5 text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue" onclick="addBarangSelect()">Tambah Barang</button>

                <!-- Divisi Pengaju -->
                <div class="mt-4 relative">
                    <x-input-label for="divisi_id" :value="__('Pilih Divisi Pengaju')" />
                    <div class="flex space-x-2 mt-2 relative">
                        <select name="divisi_id" id="divisi_id" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 dark:bg-gray-800 appearance-none dark:text-gray-400 dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" required autofocus>
                            <option value="">Pilih Divisi</option>
                            @foreach($divisi ?? [] as $div)
                            <option value="{{ $div->id }}" {{ $div->id == $pengajuan->divisi_id ? 'selected' : '' }}>{{ $div->nama_divisi }}</option>
                            @endforeach
                        </select>
                    </div>
                    <x-input-error :messages="$errors->get('divisi_id')" class="mt-2" />
                </div>

                <!-- Buttons -->
                <div class="mt-4 card-footer">
                    <button type="submit" class="px-4 py-2 text-sm font-medium leading-5 text-white bg-purple-600 rounded-lg hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">Perbarui Data</button>
                    <a href="{{ route('pengajuan.index') }}" class="px-4 py-2 text-sm font-medium leading-5 text-white bg-purple-600 rounded-lg hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">Kembali</a>
                </div>
            </div>
        </form>
    </div>

    <script>
        function addBarangSelect() {
            const container = document.getElementById('barang-container');
            const index = container.getElementsByClassName('barang-row').length;
            const selectHTML = `
            <div class="mt-4 relative" id="barang-container">
                <x-input-label for="barang_id_${index}" :value="__('Nama & Jumlah Barang')" />
                <div class="flex space-x-2 mt-2 relative barang-row" id="barang-row-${index}">
                    <select name="barang_id[]" id="barang_id_${index}" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 dark:bg-gray-800 appearance-none dark:text-gray-400 dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" required>
                        <option value="">Pilih Barang</option>
                        @foreach($barang ?? [] as $brg)
                            <option value="{{ $brg->id }}">{{ $brg->barang }}</option>
                        @endforeach
                    </select>
                    <div class="relative">
                        <x-text-input type="number" id="jumlah_${index}" name="jumlah[]" class="block w-full" placeholder=" " required />
                        <x-input-label for="jumlah_${index}" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-800 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Jumlah</x-input-label>
                    </div>
                    <button type="button" class="btn-remove-barang flex items-center px-2 py-2 text-sm font-medium text-red-700 bg-white-700 rounded-lg dark:text-gray-500 hover:dark:text-red-700 focus:outline-none focus:shadow-outline-gray">
                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                    </button>

                </div>
            </div>
            `;
            const div = document.createElement('div');
            div.innerHTML = selectHTML;
            container.appendChild(div);

            // Add event listener for the new remove button
            div.querySelector('.btn-remove-barang').addEventListener('click', function() {
                container.removeChild(div);
            });
        }

        // Add event listeners to existing remove buttons
        document.querySelectorAll('.btn-remove-barang').forEach(function(button) {
            button.addEventListener('click', function() {
                let item = button.closest('.barang-row');
                item.parentNode.removeChild(item);
            });
        });

    </script>
</x-app-layout>
