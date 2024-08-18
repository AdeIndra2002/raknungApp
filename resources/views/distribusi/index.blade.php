<x-app-layout>
    <x-slot name="header">
        {{ __('Pendistribusian') }}
    </x-slot>

    <div class="p-4 bg-white dark:bg-gray-800 rounded-lg shadow-xs">
        <!-- Start coding here -->
        <div class="p-4 grid gap-2 mb-8 xl:grid-cols-5 bg-gray-200 shadow-md dark:bg-gray-700 sm:rounded-lg">
            {{-- jumlah data berdasarkan status --}}
            <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                        <path d="M2.25 2.25a.75.75 0 0 0 0 1.5h1.386c.17 0 .318.114.362.278l2.558 9.592a3.752 3.752 0 0 0-2.806 3.63c0 .414.336.75.75.75h15.75a.75.75 0 0 0 0-1.5H5.378A2.25 2.25 0 0 1 7.5 15h11.218a.75.75 0 0 0 .674-.421 60.358 60.358 0 0 0 2.96-7.228.75.75 0 0 0-.525-.965A60.864 60.864 0 0 0 5.68 4.509l-.232-.867A1.875 1.875 0 0 0 3.636 2.25H2.25ZM3.75 20.25a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0ZM16.5 20.25a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0Z" />
                    </svg>
                </div>
                <div>
                    <p class="flex items-center mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                        Semua Proses
                        <button data-popover-target="popover-pPengadaan" data-popover-placement="bottom-end" type="button"><svg class="ml-1 w-4 h-4 text-gray-400 hover:text-gray-500" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path>
                            </svg><span class="sr-only">Show information</span>
                        </button>
                    </p>
                    <div data-popover id="popover-pPengadaan" role="tooltip" class="absolute z-10 invisible inline-block text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 w-72 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400">
                        <div class="p-3 space-y-2">
                            <h3 class="font-semibold text-gray-900 dark:text-white">Proses Pengadaan</h3>
                            <p>Proses pengadaan adalah tahapan dalam Bawaslu-Kalsel di mana barang diperoleh atau dibeli dari supplier.</p>
                            <h3 class="font-semibold text-gray-900 dark:text-white">Proses Yang Berlangsung</h3>
                            <p>Proses ini mencakup berbagai langkah mulai dari identifikasi kebutuhan, permintaan pengadaan, evaluasi penawaran, pemilihan supplier, hingga pembayaran dan penerimaan barang. Tujuan utamanya adalah untuk memastikan bahwa Bawaslu-Kalsel mendapatkan barang yang diperlukan dengan kualitas yang sesuai, pada waktu yang tepat, dan dengan harga yang kompetitif.</p>
                            <a href="{{ route('distribusi.index') }}" class="flex items-center font-medium text-blue-600 dark:text-blue-500 dark:hover:text-blue-600 hover:text-blue-700 hover:underline">Lihat Lebih Detail <svg class="w-2 h-2 ms-1.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                                </svg></a>
                        </div>
                        <div data-popper-arrow></div>
                    </div>
                    <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                        {{-- jumlah data pengadaan yang berstatus 'Diterima' --}}
                        {{ $jumlahDiterima }}

                    </p>
                </div>
            </div>
            <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                <div class="p-3 mr-4 text-teal-500 bg-teal-100 rounded-full dark:text-teal-100 dark:bg-teal-500">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                        <path d="M3.375 4.5C2.339 4.5 1.5 5.34 1.5 6.375V13.5h12V6.375c0-1.036-.84-1.875-1.875-1.875h-8.25ZM13.5 15h-12v2.625c0 1.035.84 1.875 1.875 1.875h.375a3 3 0 1 1 6 0h3a.75.75 0 0 0 .75-.75V15Z" />
                        <path d="M8.25 19.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0ZM15.75 6.75a.75.75 0 0 0-.75.75v11.25c0 .087.015.17.042.248a3 3 0 0 1 5.958.464c.853-.175 1.522-.935 1.464-1.883a18.659 18.659 0 0 0-3.732-10.104 1.837 1.837 0 0 0-1.47-.725H15.75Z" />
                        <path d="M19.5 19.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0Z" />
                    </svg>
                </div>
                <div>
                    <p class="flex items-center mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                        Proses Lanjutan
                        <button data-popover-target="popover-pLanjutan" data-popover-placement="bottom-end" type="button"><svg class="ml-1 w-4 h-4 text-gray-400 hover:text-gray-500" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">

                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path>
                            </svg><span class="sr-only">Show information</span>
                        </button>
                    </p>
                    <div data-popover id="popover-pLanjutan" role="tooltip" class="absolute z-10 invisible inline-block text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 w-72 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400">
                        <div class="p-3 space-y-2">
                            <h3 class="font-semibold text-gray-900 dark:text-white">Proses Lanjutan</h3>
                            <p>Merujuk pada langkah-langkah yang diambil setelah keputusan awal pengadaan dibuat, yang biasanya mencakup proses administratif dan operasional berikutnya.</p>
                            <h3 class="font-semibold text-gray-900 dark:text-white">Proses Yang Berlangsung</h3>
                            <p>Merujuk pada tahap-tahap yang sedang aktif atau sedang dijalankan dalam suatu siklus pengadaan. Ini mencakup aktivitas yang sedang dilakukan saat ini, seperti.
                                <br>Pembelian
                                <br>Negosiasi
                                <br>Persiapan Pengiriman
                                <br>Penerimaan dan Verifikasi
                            </p>

                            <a href="{{ route('distribusi.index') }}" class="flex items-center font-medium text-blue-600 dark:text-blue-500 dark:hover:text-blue-600 hover:text-blue-700 hover:underline">Read more <svg class="w-2 h-2 ms-1.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                                </svg></a>
                        </div>
                        <div data-popper-arrow></div>
                    </div>

                    <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                        {{-- jumlah data pembelian yang berstatus 'proses' --}}
                        {{ $jumlahProses }}
                    </p>
                </div>
            </div>
            <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                <div class="p-3 mr-4 text-green-500 bg-green-100 rounded-full dark:text-green-100 dark:bg-green-500">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                        <path fill-rule="evenodd" d="M7.502 6h7.128A3.375 3.375 0 0 1 18 9.375v9.375a3 3 0 0 0 3-3V6.108c0-1.505-1.125-2.811-2.664-2.94a48.972 48.972 0 0 0-.673-.05A3 3 0 0 0 15 1.5h-1.5a3 3 0 0 0-2.663 1.618c-.225.015-.45.032-.673.05C8.662 3.295 7.554 4.542 7.502 6ZM13.5 3A1.5 1.5 0 0 0 12 4.5h4.5A1.5 1.5 0 0 0 15 3h-1.5Z" clip-rule="evenodd" />
                        <path fill-rule="evenodd" d="M3 9.375C3 8.339 3.84 7.5 4.875 7.5h9.75c1.036 0 1.875.84 1.875 1.875v11.25c0 1.035-.84 1.875-1.875 1.875h-9.75A1.875 1.875 0 0 1 3 20.625V9.375Zm9.586 4.594a.75.75 0 0 0-1.172-.938l-2.476 3.096-.908-.907a.75.75 0 0 0-1.06 1.06l1.5 1.5a.75.75 0 0 0 1.116-.062l3-3.75Z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div>
                    <p class="flex items-center mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">

                        Proses Selesai
                        <button data-popover-target="popover-pSelesai" data-popover-placement="bottom-end" type="button"><svg class="ml-1 w-4 h-4 text-gray-400 hover:text-gray-500" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">

                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path>
                            </svg><span class="sr-only">Show information</span>
                        </button>
                    </p>
                    <div data-popover id="popover-pSelesai" role="tooltip" class="absolute z-10 invisible inline-block text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 w-72 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400">
                        <div class="p-3 space-y-2">
                            <h3 class="font-semibold text-gray-900 dark:text-white">Proses Selesai</h3>
                            <p>
                                merujuk pada tahap akhir dalam proses pengadaan barang. Pada tahap ini, semua langkah yang diperlukan untuk pengadaan telah selesai dilakukan, dan barang telah diterima serta diproses sesuai dengan persyaratan yang ditetapkan.
                            </p>
                            <h3 class="font-semibold text-gray-900 dark:text-white">Proses Yang Berlangsung</h3>
                            <p>
                                Memastikan bahwa semua aspek dari pengadaan telah dilaksanakan dengan benar dan sesuai dengan standar yang telah ditentukan, dan bahwa proyek atau pengadaan telah diselesaikan. Seperti.
                                <br>Barang telah diterima.
                                <br>Semua administrasi dan dokumentasi terkait telah lengkap.
                                <br>Penerimaan dan inspeksi barang telah dilakukan, dan barang telah dinyatakan sesuai dengan syarat dan ketentuan.
                                <br>Pembayaran kepada supplier mungkin telah dilakukan.
                            </p>
                            <a href="{{ route('distribusi.index') }}" class="flex items-center font-medium text-blue-600 dark:text-blue-500 dark:hover:text-blue-600 hover:text-blue-700 hover:underline">Read more <svg class="w-2 h-2 ms-1.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                                </svg></a>
                        </div>
                        <div data-popper-arrow></div>
                    </div>

                    <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                        {{-- jumlah data pembelian yang berstatus 'Selesai' --}}
                        {{ $jumlahSelesaiPembelian }}
                    </p>
                </div>
            </div>
            <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                <div class="p-3 mr-4 text-red-500 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-500">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                        <path fill-rule="evenodd" d="M9.401 3.003c1.155-2 4.043-2 5.197 0l7.355 12.748c1.154 2-.29 4.5-2.599 4.5H4.645c-2.309 0-3.752-2.5-2.598-4.5L9.4 3.003ZM12 8.25a.75.75 0 0 1 .75.75v3.75a.75.75 0 0 1-1.5 0V9a.75.75 0 0 1 .75-.75Zm0 8.25a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div>
                    <p class="flex items-center mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">

                        Proses Gagal
                        <button data-popover-target="popover-pGagal" data-popover-placement="bottom-end" type="button"><svg class="ml-1 w-4 h-4 text-gray-400 hover:text-gray-500" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">

                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path>
                            </svg><span class="sr-only">Show information</span>
                        </button>
                    </p>
                    <div data-popover id="popover-pGagal" role="tooltip" class="absolute z-10 invisible inline-block text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 w-72 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400">
                        <div class="p-3 space-y-2">
                            <h3 class="font-semibold text-gray-900 dark:text-white">Proses Gagal</h3>
                            <p>merujuk pada situasi di mana usaha untuk memperoleh barang tidak berhasil mencapai tujuannya. Ini bisa terjadi karena berbagai alasan seperti:
                                <br>Ketidakcocokan: Barang yang disediakan tidak sesuai dengan spesifikasi yang diinginkan.
                                <br>Harga: Penawaran yang diterima terlalu tinggi atau tidak sesuai anggaran.
                                <br>Kualifikasi: Penyedia barang tidak memenuhi syarat yang ditetapkan.
                                <br>Masalah Administratif: Dokumen atau proses administratif tidak lengkap atau tidak sesuai.
                            </p>
                            <a href="{{ route('distribusi.index') }}" class="flex items-center font-medium text-blue-600 dark:text-blue-500 dark:hover:text-blue-600 hover:text-blue-700 hover:underline">Read more <svg class="w-2 h-2 ms-1.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                                </svg></a>
                        </div>
                        <div data-popper-arrow></div>
                    </div>

                    <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                        {{-- jumlah data pembelian yang berstatus 'Gagal' --}}
                        {{ $jumlahGagal }}
                    </p>
                </div>
            </div>
            <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                        <path d="M9.97.97a.75.75 0 0 1 1.06 0l3 3a.75.75 0 0 1-1.06 1.06l-1.72-1.72v3.44h-1.5V3.31L8.03 5.03a.75.75 0 0 1-1.06-1.06l3-3ZM9.75 6.75v6a.75.75 0 0 0 1.5 0v-6h3a3 3 0 0 1 3 3v7.5a3 3 0 0 1-3 3h-7.5a3 3 0 0 1-3-3v-7.5a3 3 0 0 1 3-3h3Z" />
                        <path d="M7.151 21.75a2.999 2.999 0 0 0 2.599 1.5h7.5a3 3 0 0 0 3-3v-7.5c0-1.11-.603-2.08-1.5-2.599v7.099a4.5 4.5 0 0 1-4.5 4.5H7.151Z" />
                    </svg>
                </div>
                <div>
                    <p class="flex items-center mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">

                        Pengadaan Terkonfirmasi
                        <button data-popover-target="popover-pKonfirm" data-popover-placement="bottom-end" type="button"><svg class="ml-1 w-4 h-4 text-gray-400 hover:text-gray-500" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">

                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path>
                            </svg><span class="sr-only">Show information</span>
                        </button>
                    </p>
                    <div data-popover id="popover-pKonfirm" role="tooltip" class="absolute z-10 invisible inline-block text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 w-72 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400">
                        <div class="p-3 space-y-2">
                            <h3 class="font-semibold text-gray-900 dark:text-white">Pengadaan Terkonfirmasi</h3>
                            <p>Ini mengacu pada status di mana semua langkah yang diperlukan dalam proses pengadaan telah selesai dan dikonfirmasi. Biasanya, ini berarti bahwa barang yang diminta telah diperoleh dan diterima dengan benar, serta semua dokumentasi dan persetujuan yang diperlukan telah diselesaikan.</p>

                            <a href="{{ route('distribusi.index') }}" class="flex items-center font-medium text-blue-600 dark:text-blue-500 dark:hover:text-blue-600 hover:text-blue-700 hover:underline">Read more <svg class="w-2 h-2 ms-1.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                                </svg></a>
                        </div>
                        <div data-popper-arrow></div>
                    </div>

                    <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                        {{-- jumlah data distribusi yang berstatus 'Selesai' --}}
                        {{ $jumlahSelesaiDistribusi }}
                    </p>
                </div>
            </div>
        </div>

        <div class="w-full overflow-hidden rounded-lg shadow-xs ">
            <div class="w-full overflow-x-auto mb-8 rounded-lg shadow-md">
                <table class="w-full whitespace-no-wrap bg-gray-100 dark:bg-gray-600">
                    <thead>
                        <tr class="text-xs font-semibold tracking-wide text-center bg-gray-200 text-gray-500 uppercase border-b dark:border-gray-600 dark:text-gray-400 dark:bg-gray-700">
                            <th class="px-4 py-3">No</th>
                            <th class="px-4 py-3">Nama Pengaju</th>
                            <th class="px-4 py-3">Divisi</th>
                            <th class="px-4 py-3">Total Harga</th>
                            <th class="px-4 py-3">Proses Pengadaan</th>
                        </tr>
                    </thead>
                    <tbody class="text-xs font-semibold tracking-wide text-center bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300">
                        @if ($pengajuan->count() > 0)
                        @foreach($pengajuan as $data)
                        <tr class="border-b border-gray-200 dark:border-gray-600">
                            <td class="px-4 py-3">{{ $loop->iteration }}</td>
                            <td class="px-4 py-3">{{ $data->nama_pengaju }}</td>
                            <td class="px-4 py-3">{{ $data->divisi->nama_divisi }}</td>
                            <td class="px-4 py-3">Rp. {{ number_format($data->pembelian->first()->total_harga ?? 0, 0, ',', '.') }}</td>
                            <td class="px-4 py-3">
                                <div class="flex justify-center space-x-1">

                                    <!-- Modal Trigger distribusi -->
                                    <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-distribusi-{{ $data->id }}')" class="flex items-center px-2 py-2 text-sm font-medium text-yellow-700 bg-white-700 rounded-lg dark:text-gray-500 hover:dark:text-yellow-700 focus:outline-none focus:shadow-outline-gray">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                            <path d="M3.375 4.5C2.339 4.5 1.5 5.34 1.5 6.375V13.5h12V6.375c0-1.036-.84-1.875-1.875-1.875h-8.25ZM13.5 15h-12v2.625c0 1.035.84 1.875 1.875 1.875h.375a3 3 0 1 1 6 0h3a.75.75 0 0 0 .75-.75V15Z" />
                                            <path d="M8.25 19.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0ZM15.75 6.75a.75.75 0 0 0-.75.75v11.25c0 .087.015.17.042.248a3 3 0 0 1 5.958.464c.853-.175 1.522-.935 1.464-1.883a18.659 18.659 0 0 0-3.732-10.104 1.837 1.837 0 0 0-1.47-.725H15.75Z" />
                                            <path d="M19.5 19.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0Z" />
                                        </svg>
                                    </button>

                                    <!-- Modal distribusi -->
                                    <!-- Modal distribusi -->
                                    <x-modal name="confirm-distribusi-{{ $data->id }}" focusable>
                                        <form method="post" action="{{ route('distribusi.store') }}" class="p-6">
                                            @csrf
                                            <input type="hidden" name="pengajuan_id" value="{{ $data->id }}">

                                            <h2 class="text-lg font-medium text-gray-400">
                                                {{ __('Proses Pengadaan') }}
                                            </h2>
                                            <ol class="relative border-s border-gray-200 dark:border-gray-500">
                                                <!-- Step: Pengajuan Diterima -->
                                                @if($data->status == 'Diterima')
                                                <li class="mb-10 ms-4">
                                                    <div class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -start-1.5 border border-white dark:border-gray-500 dark:bg-gray-500"></div>
                                                    <time class="mb-1 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">
                                                        {{ $data->created_at->format('d F Y, H:i') }}
                                                    </time>
                                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Sedang dalam Proses Pengadaan</h3>
                                                    <p class="text-base font-normal text-gray-500 dark:text-gray-400">Pengajuan telah selesai dan sedang dalam proses pengadaan.</p>
                                                </li>
                                                @endif
                                                {{-- @foreach($data->pembelian as $p ) --}}
                                                <!-- Step: Proses Pengadaan -->
                                                @if($data->pembelian->whereIn('status', ['Proses', 'Selesai', 'Gagal'])->count() > 0)
                                                <li class="mb-10 ms-4">
                                                    <div class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -start-1.5 border border-white dark:border-gray-500 dark:bg-gray-500"></div>
                                                    <time class="mb-1 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">
                                                        {{ $data->pembelian->first()->created_at->format('d F Y, H:i') }}
                                                    </time>
                                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Proses Pengadaan Berada Tahapan Lanjutan</h3>
                                                    <p class="text-base font-normal text-gray-500 dark:text-gray-400">Pengadaan telah memasuki tahapan lanjutan.</p>
                                                </li>
                                                @endif

                                                <!-- Step: Pengadaan Selesai -->
                                                @if($data->pembelian->where('status', 'Selesai')->count() > 0)
                                                <li class="mb-10 ms-4">
                                                    <div class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -start-1.5 border border-white dark:border-gray-500 dark:bg-gray-500"></div>
                                                    <time class="mb-1 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">
                                                        {{ $data->pembelian->first()->updated_at->format('d F Y, H:i') }}
                                                    </time>
                                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Pengadaan Sudah Selesai Dilaksanakan</h3>
                                                    <p class="text-base font-normal text-gray-500 dark:text-gray-400">Proses pengadaan telah selesai.</p>
                                                </li>
                                                @endif

                                                <!-- Step: Pengadaan Gagal -->
                                                @if($data->pembelian->where('status', 'Gagal')->count() > 0)
                                                <li class="ms-4">
                                                    <div class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -start-1.5 border border-white dark:border-gray-500 dark:bg-gray-500"></div>
                                                    <time class="mb-1 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">
                                                        {{ $data->pembelian->first()->updated_at->format('d F Y, H:i') }}
                                                    </time>
                                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Pengadaan Gagal Dilaksanakan</h3>
                                                    <p class="text-base font-normal text-gray-500 dark:text-gray-400">Pengadaan tidak dapat dilaksanakan.</p>
                                                    <textarea name="note" id="note" rows="3" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:text-gray-400 dark:border-gray-600" readonly>{{ $data->pembelian->first()->note }}</textarea>
                                                </li>
                                                @endif
                                                <!-- Step: Pengadaan dikonfirmasi -->
                                                @if($data->distribusi->where('status', 'Selesai')->count() > 0)
                                                <li class="ms-4">
                                                    <div class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -start-1.5 border border-white dark:border-gray-500 dark:bg-gray-500"></div>
                                                    <time class="mb-1 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">
                                                        {{ $data->distribusi->first()->created_at->format('d F Y, H:i') }}
                                                    </time>
                                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Pengadaan Sudah Dikonfirmasi</h3>
                                                    <p class="text-base font-normal text-gray-500 dark:text-gray-400">Pengadaan sudah dikonfirmasi dan sudah diserahkan ke pihak pengaju.</p>
                                                </li>
                                                @endif
                                            </ol>
                                            <div class="mt-6 flex justify-end">
                                                <x-secondary-button x-on:click="$dispatch('close')">
                                                    {{ __('Kembali') }}
                                                </x-secondary-button>
                                                @if($data->pembelian->where('status', 'Selesai')->count() > 0)
                                                <x-primary-button class="ms-3" type="submit">
                                                    {{ __('Setujui') }}
                                                </x-primary-button>
                                                @endif
                                            </div>
                                        </form>
                                    </x-modal>
                                </div>
                            </td>
                        </tr>
                        @endforeach

                        @else
                        <tr>
                            <td class="text-center py-4" colspan="8">DATA NOT FOUND</td>
                        </tr>

                        @endif
                    </tbody>

                </table>
                <div class="px-4 py-3 text-xs font-semibold border-t border-gray-200 dark:border-gray-600 tracking-wide text-gray-500 uppercase bg-gray-200 dark:bg-gray-700  sm:grid-cols-9">
                    {{ $pengajuan->links() }}
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
