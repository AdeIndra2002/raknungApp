<x-app-layout>
    <x-slot name="header">
        {{ __('Edit Penerimaan') }}
    </x-slot>

    <div class="container px-6 mx-auto grid">
        <form action="{{ route('penerimaan.update', $penerimaan->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="px-6 py-4 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                <!-- Pengajuan ID -->
                <div class="mb-4 relative">
                    <x-input-label for="pembelian_id" :value="__('Nama & Divisi Pengaju')" />
                    <select name="pembelian_id" id="pembelian_id" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 dark:bg-gray-800 appearance-none dark:text-gray-400 dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" required>
                        <option value="">Pilih Nama Pengaju</option>
                        @foreach ($pembelian as $p)
                        <option value="{{ $p->id }}" {{ $p->id == old('pembelian_id', $penerimaan->pembelian_id) ? 'selected' : '' }}>{{ $p->pengajuan->nama_pengaju}} - {{ $p->pengajuan->divisi->nama_divisi }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('pembelian_id')" class="mt-2" />
                </div>

                <!-- Display Barang and Jumlah -->
                <div id="pengajuan-details" class="mb-4">
                    <!-- Details will be populated via JavaScript -->
                </div>

                <!-- Gambar penerimaan -->
                <div id="image-supplier-fields">
                    @foreach ($penerimaan->GambarPenerimaan as $index => $gambar)
                    <div class="image-supplier-row mb-4 relative" data-index="{{ $index }}">
                        <input type="hidden" name="gambar_id[]" value="{{ $gambar->id }}"> <!-- Store gambar ID -->
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white mt-6" for="gambar_{{ $index }}">Gambar Nota</label>
                        <input name="gambar[]" class="block w-full text-lg text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="gambar_{{ $index }}" type="file">
                        @if($gambar->gambar)
                        <img src="{{ asset('storage/images/' . $gambar->gambar) }}" alt="Gambar Nota" class="mt-2 w-24 h-24 object-cover">
                        @endif
                    </div>
                    @endforeach
                </div>

                <!-- Button to add more gambar -->
                <div class="mb-4">
                    <button type="button" id="add-more" class="px-4 py-2 text-sm font-medium leading-5 text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue">Tambah Gambar</button>
                </div>

                <!-- Container for additional gambar -->
                <div id="additional-fields"></div>

                <!-- Submit Button -->
                <div class="mt-4 flex space-x-2">
                    <button type="submit" class="px-4 py-2 text-sm font-medium leading-5 flex items-center justify-center text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg text-center">Update Data</button>
                    <a href="{{ route('penerimaan.index') }}" class="flex items-center justify-center px-4 py-2 text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm text-center">Kembali</a>
                </div>
            </div>
        </form>
    </div>

    <script>
        // Fetch pengajuan details when pembelian_id is changed
        document.getElementById('pembelian_id').addEventListener('change', function() {
            const pembelianId = this.value;

            if (pembelianId) {
                fetch(`/penerimaan/get-pengajuan-details/${pembelianId}`)
                    .then(response => response.json())
                    .then(data => {
                        const pengajuanDetails = document.getElementById('pengajuan-details');
                        pengajuanDetails.innerHTML = '';

                        data.pengajuanBarang.forEach(item => {
                            pengajuanDetails.innerHTML += `
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-900 dark:text-white">Barang</label>
                                    <input type="text" class="block w-full text-lg text-gray-900 border border-gray-300 rounded-lg" value="${item.barang.nama_barang}" readonly>
                                    <label class="block text-sm font-medium text-gray-900 dark:text-white mt-2">Jumlah</label>
                                    <input type="number" name="jumlah_barang[]" class="block w-full text-lg text-gray-900 border border-gray-300 rounded-lg" value="${item.jumlah}" min="0">
                                    <input type="hidden" name="barang_id[]" value="${item.barang.id}">
                                </div>
                            `;
                        });
                    });
            }
        });

        // Handle adding and removing gambar fields
        document.getElementById('add-more').addEventListener('click', function() {
            const container = document.getElementById('additional-fields');
            const index = container.children.length;

            const newFields = `
            <div class="relative">
                <button type="button" class="remove-field absolute top-0 right-0 px-2 py-1 text-sm font-medium leading-5 flex items-center px-2 py-2 text-sm font-medium text-red-700 bg-white-700 rounded-lg dark:text-gray-500 hover:dark:text-red-700 focus:outline-none focus:shadow-outline-gray" aria-label="Hapus">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
                <div class="pt-1">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="gambar_${index}">Gambar Nota</label>
                    <input class="block w-full text-lg text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="gambar_${index}" type="file" name="gambar[]">
                </div>
            </div>
        `;

            container.insertAdjacentHTML('beforeend', newFields);

            // Add event listener to newly added remove button
            container.querySelectorAll('.remove-field').forEach(button => {
                button.addEventListener('click', function() {
                    this.closest('div.relative').remove();
                });
            });
        });

    </script>

</x-app-layout>
