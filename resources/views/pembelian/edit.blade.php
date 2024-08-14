<x-app-layout>
    <x-slot name="header">
        {{ __('Edit Pembelian') }}
    </x-slot>

    <div class="container px-6 mx-auto grid">
        <form action="{{ route('pembelian.update', $pembelian->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                <!-- Nama Pengaju -->
                <div class="mb-4 relative">
                    <x-input-label for="pengajuan_id" :value="__('Nama & Divisi Pengaju')" />
                    <select name="pengajuan_id" id="pengajuan_id" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 dark:bg-gray-800 appearance-none dark:text-gray-400 dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" required>
                        <option value="">Pilih Nama Pengaju</option>
                        @foreach ($pengajuans as $pengajuan)
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
                        <input name="gambar[]" class="block w-full text-lg text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="gambar_{{ $index }}" type="file">
                        @if($gambar->gambar)
                        <img src="{{ asset('storage/images/' . $gambar->gambar) }}" alt="Gambar Nota" class="mt-2 w-24 h-24 object-cover">
                        @endif
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white mt-4" for="supplier_{{ $index }}">Pilih Supplier</label>
                        <select name="supplier_id[]" id="supplier_{{ $index }}" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 dark:bg-gray-800 appearance-none dark:text-gray-400 dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer">
                            <option value="">Pilih Nama Supplier</option>
                            @foreach ($suppliers as $supplier)
                            <option value="{{ $supplier->id }}" {{ $supplier->id == old('supplier_id.' . $index, $gambar->supplier_id) ? 'selected' : '' }}>{{ $supplier->nama_supplier }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('supplier_id.' . $index)" class="mt-2" />
                    </div>
                    @endforeach
                </div>

                <button type="button" id="add-row" class="px-4 py-2 text-sm font-medium leading-5 text-white bg-green-600 rounded-lg hover:bg-green-700 focus:outline-none focus:shadow-outline-green">Tambah Baris</button>

                <!-- Buttons -->
                <div class="mt-4 card-footer">
                    <button type="submit" class="px-4 py-2 text-sm font-medium leading-5 text-white bg-purple-600 rounded-lg hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">Perbarui Data</button>
                    <a href="{{ route('pembelian.index') }}" class="px-4 py-2 text-sm font-medium leading-5 text-white bg-purple-600 rounded-lg hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">Kembali</a>
                    <a href="{{ route('pembelians.hapusGambar', $pembelian->id) }}" class="px-4 py-2 text-sm font-medium leading-5 text-white bg-red-600 rounded-lg hover:bg-red-700 focus:outline-none focus:shadow-outline-red">
                        Hapus Gambar
                    </a>

                </div>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let index = document.querySelectorAll('.image-supplier-row').length;

            function addRow() {
                const container = document.getElementById('image-supplier-fields');
                const newRow = document.createElement('div');
                newRow.className = 'image-supplier-row mb-4 relative';
                newRow.setAttribute('data-index', index);
                newRow.innerHTML = `
            <input type="hidden" name="removed_rows[${index}]" value="">
            <button type="button" class="remove-row absolute top-0 right-0 px-2 py-1 text-red-600 hover:text-red-800">×</button>
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white mt-6" for="gambar_${index}">Gambar Nota</label>
            <input name="gambar[]" class="block w-full text-lg text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="gambar_${index}" type="file" onchange="previewImage(event, ${index})">
            <img id="preview_${index}" src="" alt="Image Preview" class="mt-2 w-24 h-24 object-cover" style="display:none;">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white mt-4" for="supplier_${index}">Pilih Supplier</label>
            <select name="supplier_id[]" id="supplier_${index}" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 dark:bg-gray-800 appearance-none dark:text-gray-400 dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer">
                <option value="">Pilih Nama Supplier</option>
                @foreach ($suppliers as $supplier)
                <option value="{{ $supplier->id }}">{{ $supplier->nama_supplier }}</option>
                @endforeach
            </select>
            `;
                container.appendChild(newRow);
                index++;

                newRow.querySelector('.remove-row').addEventListener('click', function() {
                    const row = newRow;
                    row.querySelector('input[type="hidden"]').value = 'removed'; // Mark this row for removal
                    row.style.display = 'none'; // Hide the row
                });
            }

            function previewImage(event, index) {
                const reader = new FileReader();
                const imgPreview = document.getElementById(`preview_${index}`);

                reader.onload = function(e) {
                    imgPreview.src = e.target.result;
                    imgPreview.style.display = 'block';
                };

                if (event.target.files[0]) {
                    reader.readAsDataURL(event.target.files[0]);
                }
            }



            document.getElementById('add-row').addEventListener('click', addRow);

            document.querySelectorAll('.remove-row').forEach(function(button) {
                button.addEventListener('click', function() {
                    const row = button.closest('.image-supplier-row');
                    row.querySelector('input[type="hidden"]').value = 'removed'; // Mark this row for removal
                    row.style.display = 'none'; // Hide the row
                });
            });
        });

    </script>
</x-app-layout>
