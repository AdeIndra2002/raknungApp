<x-app-layout>
    <x-slot name="header">
        {{ __('Tambah Pembelian') }}
    </x-slot>

    <div class="container px-6 mx-auto grid">
        <form action="{{ route('pembelian.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="px-6 py-4 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                <!-- Pengajuan ID -->
                <div class="mb-4 relative">
                    <x-input-label for="pengajuan_id" :value="__('Nama & Divisi Pengaju')" />
                    <select name="pengajuan_id" id="pengajuan_id" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 dark:bg-gray-800 appearance-none dark:text-gray-400 dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" required>
                        <option value="">Pilih Nama Pengaju</option>
                        @foreach ($pengajuans as $pengajuan)
                        <option value="{{ $pengajuan->id }}">{{ $pengajuan->nama_pengaju }} - {{ $pengajuan->divisi->nama_divisi }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('pengajuan_id')" class="mt-2" />
                </div>

                <!-- Total Harga -->
                <div class="mb-4 relative">
                    <x-text-input placeholder=" " type="text" id="total_harga" name="total_harga" class="block w-full" value="{{ old('total_harga') }}" required />
                    <x-input-label for="total_harga" :value="__('Total Harga')" />
                    <x-input-error :messages="$errors->get('total_harga')" class="mt-2" />
                </div>

                <!-- Gambar Pembelian dan Supplier -->
                <div id="image-supplier-fields">
                    <div class="mb-4 relative">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="gambar">Gambar Nota</label>
                        <input name="gambar[]" class="block w-full text-lg text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="gambar" type="file" multiple required>
                        <x-input-error :messages="$errors->get('gambar')" class="mt-2" />
                    </div>

                    <div class="mb-4 relative">
                        <x-input-label for="supplier_id" :value="__('Nama Supplier')" />
                        <select name="supplier_id[]" id="supplier_id" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 dark:bg-gray-800 appearance-none dark:text-gray-400 dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" required>
                            <option value="">Pilih Nama Supplier</option>
                            @foreach ($suppliers as $supplier)
                            <option value="{{ $supplier->id }}">{{ $supplier->nama_supplier }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('supplier_id')" class="mt-2" />
                    </div>
                </div>

                <!-- Button to add more suppliers and gambar -->
                <div class="mb-4">
                    <button type="button" id="add-more" class="px-4 py-2 text-sm font-medium leading-5 text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue">Tambah Supplier dan Gambar</button>
                </div>

                <!-- Container for additional suppliers and gambar -->
                <div id="additional-fields"></div>

                <!-- Submit Button -->
                <div class="mt-4 flex space-x-2">
                    <button type="submit" class="px-4 py-2 text-sm font-medium leading-5 flex items-center justify-center text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg text-center">Tambah Data</button>
                    <a href="{{ route('pembelian.index') }}" class="flex items-center justify-center px-4 py-2 text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm text-center">Kembali</a>
                </div>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('add-more').addEventListener('click', function() {
            const container = document.getElementById('additional-fields');
            const index = container.children.length; // Determine the index for new fields

            const newFields = `
            <div class=" relative">
                <button type="button" class="remove-field absolute top-0 right-0 px-2 py-1 text-sm font-medium leading-5 flex items-center px-2 py-2 text-sm font-medium text-red-700 bg-white-700 rounded-lg dark:text-gray-500 hover:dark:text-red-700 focus:outline-none focus:shadow-outline-gray" aria-label="Hapus">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
                <div class="pt-1">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="gambar_${index}">Gambar Nota</label>
                    <input class="block w-full text-lg text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="gambar_${index}" type="file" name="gambar[]">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white mt-4" for="supplier_${index}">Pilih Supplier</label>
                    <select name="supplier_id[]" id="supplier_${index}" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 dark:bg-gray-800 appearance-none dark:text-gray-400 dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer">
                        <option value="">Pilih Supplier</option>
                        @foreach ($suppliers as $supplier)
                            <option value="{{ $supplier->id }}">{{ $supplier->nama_supplier }}</option>
                        @endforeach
                    </select>
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
