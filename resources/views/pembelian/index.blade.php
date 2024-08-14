<x-app-layout>
    <x-slot name="header">
        {{ __('Daftar Pembelian') }}
    </x-slot>

    <div class="p-4 bg-white dark:bg-gray-800 rounded-lg shadow-xs">
        <div class="flex flex-col relative mb-4 bg-gray-200 shadow-md dark:bg-gray-700 sm:rounded-lg">
            <h1 class="pt-2 pl-4 text-xl font-semibold text-gray-700 dark:text-gray-400">
                Cetak Laporan
            </h1>
            <div class="flex flex-col items-center justify-between p-4 space-y-3 md:flex-row md:space-y-0 md:space-x-4">
                <form action="{{ route('pengajuan.laporan') }}" method="GET">
                    <p class="pb-2 text-sm font-semibold text-gray-700 dark:text-gray-400">Cetak Laporan Berdasarkan Divisi</p>
                    <div class="flex space-x-4">
                        <!-- Input Label dan Select -->
                        <div class="flex relative">
                            <select class="block w-max text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 dark:bg-gray-800 appearance-none dark:text-gray-400 dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" id="division" name="division">
                                <option value="">Semua Divisi</option>
                                {{-- @foreach ($divisi as $item) --}}
                                {{-- <option value="{{ $item->id }}">{{ $item->nama_divisi }}</option> --}}
                                {{-- @endforeach --}}
                            </select>
                        </div>
                        <!-- Button -->
                        <div>
                            <button type="submit" id="generate_pdf" name="generate_pdf" class="flex items-center justify-center w-full px-4 py-2 text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                    <path d="M11.625 16.5a1.875 1.875 0 1 0 0-3.75 1.875 1.875 0 0 0 0 3.75Z" />
                                    <path fill-rule="evenodd" d="M5.625 1.5H9a3.75 3.75 0 0 1 3.75 3.75v1.875c0 1.036.84 1.875 1.875 1.875H16.5a3.75 3.75 0 0 1 3.75 3.75v7.875c0 1.035-.84 1.875-1.875 1.875H5.625a1.875 1.875 0 0 1-1.875-1.875V3.375c0-1.036.84-1.875 1.875-1.875Zm6 16.5c.66 0 1.277-.19 1.797-.518l1.048 1.048a.75.75 0 0 0 1.06-1.06l-1.047-1.048A3.375 3.375 0 1 0 11.625 18Z" clip-rule="evenodd" />
                                    <path d="M14.25 5.25a5.23 5.23 0 0 0-1.279-3.434 9.768 9.768 0 0 1 6.963 6.963A5.23 5.23 0 0 0 16.5 7.5h-1.875a.375.375 0 0 1-.375-.375V5.25Z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </form>
                <form action="{{ route('pengajuan.waktu') }}" method="GET">
                    <p class="pb-2 text-sm font-semibold text-gray-700 dark:text-gray-400">Cetak Laporan Berdasarkan Waktu</p>
                    <div class="flex space-x-4">

                        <select id="periode" name="periode" class="block w-max text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 dark:bg-gray-800 appearance-none dark:text-gray-400 dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" onchange="showInput()">
                            <option value="hari">Hari</option>
                            <option value="minggu">Minggu</option>
                            <option value="bulan">Bulan</option>
                            <option value="tahun">Tahun</option>
                        </select>

                        <div id="input-container" class="block w-full">
                            <!-- Dynamic input will be inserted here -->
                        </div>

                        <button type="submit" class="flex items-center justify-center w-full px-4 py-2 text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm text-center">Cetak</button>
                    </div>
                </form>

            </div>
            <div class="flex flex-col items-center justify-between p-4 space-y-3 md:flex-row md:space-y-0 md:space-x-4">
                <form action="{{ route('pengajuan.status') }}" method="GET">
                    <p class="pb-2 text-sm font-semibold text-gray-700 dark:text-gray-400">Cetak Laporan Berdasarkan Status</p>
                    <div class="relative flex space-x-4">
                        <div class="flex relative">
                            <div class="flex relative">
                                <select id="status" name="status" class="block w-max text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 dark:bg-gray-800 appearance-none dark:text-gray-400 dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer">
                                    <option value="Pending">Pending</option>
                                    <option value="Diterima">Diterima</option>
                                    <option value="Ditolak">Ditolak</option>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="flex items-center justify-center w-full px-4 py-2 text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                <path d="M11.625 16.5a1.875 1.875 0 1 0 0-3.75 1.875 1.875 0 0 0 0 3.75Z" />
                                <path fill-rule="evenodd" d="M5.625 1.5H9a3.75 3.75 0 0 1 3.75 3.75v1.875c0 1.036.84 1.875 1.875 1.875H16.5a3.75 3.75 0 0 1 3.75 3.75v7.875c0 1.035-.84 1.875-1.875 1.875H5.625a1.875 1.875 0 0 1-1.875-1.875V3.375c0-1.036.84-1.875 1.875-1.875Zm6 16.5c.66 0 1.277-.19 1.797-.518l1.048 1.048a.75.75 0 0 0 1.06-1.06l-1.047-1.048A3.375 3.375 0 1 0 11.625 18Z" clip-rule="evenodd" />
                                <path d="M14.25 5.25a5.23 5.23 0 0 0-1.279-3.434 9.768 9.768 0 0 1 6.963 6.963A5.23 5.23 0 0 0 16.5 7.5h-1.875a.375.375 0 0 1-.375-.375V5.25Z" />
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <!-- Start coding here -->
        <div class="relative mb-4 bg-gray-200 shadow-md dark:bg-gray-700 sm:rounded-lg">
            <div class="flex flex-col items-center justify-between p-4 space-y-3 md:flex-row md:space-y-0 md:space-x-4">
                <div class="flex flex-col items-stretch justify-end flex-shrink-0 w-full space-y-2 md:w-auto md:flex-row md:space-y-0 md:items-center md:space-x-3">
                    <div class="flex items-center w-full space-x-3 md:w-auto">
                        <button type="button" class="flex items-center justify-center w-full px-4 py-2 text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm text-center">
                            <svg class="h-3.5 w-3.5 mt-1 mr-2" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path clip-rule="evenodd" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                            </svg>
                            <a href="{{ route('pembelian.create') }}">Tambah Data</a>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-full overflow-hidden rounded-lg shadow-xs ">
            <div class="w-full overflow-x-auto mb-8 rounded-lg shadow-md">
                <table class="w-full whitespace-no-wrap bg-gray-100 dark:bg-gray-600">
                    <thead>
                        <tr class="text-xs font-semibold tracking-wide text-center bg-gray-200 text-gray-500 uppercase border-b dark:border-gray-600 dark:text-gray-400 dark:bg-gray-700">
                            <th class="px-4 py-3">No</th>
                            <th class="px-4 py-3">Nama & Divisi Pengaju</th>
                            <th class="px-4 py-3">Total Harga</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-xs font-semibold tracking-wide text-center bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300">
                        @if ($pembelian->count() > 0)
                        @foreach($pembelian as $data)
                        <tr class="border-b border-gray-200 dark:border-gray-600">
                            <td class="px-4 py-3">{{ $loop->iteration }}</td>
                            <td class="px-4 py-3">{{ $data->pengajuan->nama_pengaju }} - {{ $data->pengajuan->divisi->nama_divisi }}</td>
                            <td class="px-4 py-3">{{ $data->total_harga }}</td>
                            <td class="px-4 py-3">
                                @if ($data->status == 'Selesai')
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-500 text-white">
                                    Selesai
                                </span>
                                @elseif ($data->status == 'Gagal')
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-500 text-white">
                                    Gagal
                                </span>
                                @elseif ($data->status == 'Proses')
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-500 text-white">
                                    Proses
                                </span>
                                @endif
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex justify-center space-x-1">
                                    <a href="{{ route('pembelian.show', $data->id) }}" class="flex items-center px-2 py-2 text-sm font-medium leading-5 text-green-400 bg-white-300 rounded-lg dark:text-gray-500 hover:dark:text-green-300 focus:outline-none focus:shadow-outline-gray" aria-label="Edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                            <path d="M11.625 16.5a1.875 1.875 0 1 0 0-3.75 1.875 1.875 0 0 0 0 3.75Z" />
                                            <path fill-rule="evenodd" d="M5.625 1.5H9a3.75 3.75 0 0 1 3.75 3.75v1.875c0 1.036.84 1.875 1.875 1.875H16.5a3.75 3.75 0 0 1 3.75 3.75v7.875c0 1.035-.84 1.875-1.875 1.875H5.625a1.875 1.875 0 0 1-1.875-1.875V3.375c0-1.036.84-1.875 1.875-1.875Zm6 16.5c.66 0 1.277-.19 1.797-.518l1.048 1.048a.75.75 0 0 0 1.06-1.06l-1.047-1.048A3.375 3.375 0 1 0 11.625 18Z" clip-rule="evenodd" />
                                            <path d="M14.25 5.25a5.23 5.23 0 0 0-1.279-3.434 9.768 9.768 0 0 1 6.963 6.963A5.23 5.23 0 0 0 16.5 7.5h-1.875a.375.375 0 0 1-.375-.375V5.25Z" />
                                        </svg>
                                    </a>
                                    <a href="{{ route('pembelian.edit', $data->id) }}" class="flex items-center px-2 py-2 text-sm font-medium leading-5 text-yellow-300 bg-white-300 rounded-lg dark:text-gray-500 hover:dark:text-yellow-300 focus:outline-none focus:shadow-outline-gray" aria-label="Edit">
                                        <svg class="w-5 h-5 tr" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                        </svg>
                                    </a>
                                    <!-- Modal Trigger -->
                                    <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-pembelian-deletion-{{ $data->id }}')" class="flex items-center px-2 py-2 text-sm font-medium text-red-700 bg-white-700 rounded-lg dark:text-gray-500 hover:dark:text-red-700 focus:outline-none focus:shadow-outline-gray">
                                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                        </svg>
                                    </button>
                                    <!-- Modal -->
                                    <x-modal name="confirm-pembelian-deletion-{{ $data->id }}" focusable>
                                        <form method="post" action="{{ route('pembelian.destroy', $data->id) }}" class="p-6">
                                            @csrf
                                            @method('delete')
                                            <h2 class="text-lg font-medium text-gray-400">
                                                {{ __('Apakah anda yakin ingin menghapus data pembelian ini?') }}
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

                                    <!-- Modal Trigger Verify -->
                                    <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-pembelian-vefiry-{{ $data->id }}')" class="flex items-center px-2 py-2 text-sm font-medium text-green-700 bg-white-700 rounded-lg dark:text-gray-500 hover:dark:text-green-700 focus:outline-none focus:shadow-outline-gray">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                            <path fill-rule="evenodd" d="M9 1.5H5.625c-1.036 0-1.875.84-1.875 1.875v17.25c0 1.035.84 1.875 1.875 1.875h12.75c1.035 0 1.875-.84 1.875-1.875V12.75A3.75 3.75 0 0 0 16.5 9h-1.875a1.875 1.875 0 0 1-1.875-1.875V5.25A3.75 3.75 0 0 0 9 1.5Zm6.61 10.936a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 14.47a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z" clip-rule="evenodd" />
                                            <path d="M12.971 1.816A5.23 5.23 0 0 1 14.25 5.25v1.875c0 .207.168.375.375.375H16.5a5.23 5.23 0 0 1 3.434 1.279 9.768 9.768 0 0 0-6.963-6.963Z" />
                                        </svg>
                                    </button>
                                    <!-- Modal Verify -->
                                    <x-modal name="confirm-pembelian-vefiry-{{ $data->id }}" focusable>
                                        <form method="post" action="{{ route('pembelian.verif', $data->id) }}" class="p-6">
                                            @csrf
                                            @method('PATCH')
                                            <h2 class="text-lg font-medium text-gray-400">
                                                {{ __('Selesaikan pembelian') }}
                                            </h2>
                                            <p class="mt-1 text-sm text-gray-500">
                                                {{ __('Anda akan menyelesaikan pembelian, maka "STATUS" pada data akan berubah jadi "Selesai". Silahkan klik tombol "Setujui" untuk menyelesaikan pembelian.') }}
                                            </p>
                                            <div class="mt-6 flex justify-end">
                                                <x-secondary-button x-on:click="$dispatch('close')">
                                                    {{ __('Kembali') }}
                                                </x-secondary-button>
                                                <x-primary-button class="ms-3">
                                                    {{ __('Setujui') }}
                                                </x-primary-button>
                                            </div>
                                        </form>
                                    </x-modal>

                                    <!-- Modal Trigger Rejected -->
                                    <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-pembelian-rejected-{{ $data->id }}')" class="flex items-center px-2 py-2 text-sm font-medium text-red-700 bg-white-700 rounded-lg dark:text-gray-500 hover:dark:text-red-700 focus:outline-none focus:shadow-outline-gray">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                            <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25Zm-1.72 6.97a.75.75 0 1 0-1.06 1.06L10.94 12l-1.72 1.72a.75.75 0 1 0 1.06 1.06L12 13.06l1.72 1.72a.75.75 0 1 0 1.06-1.06L13.06 12l1.72-1.72a.75.75 0 1 0-1.06-1.06L12 10.94l-1.72-1.72Z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                    <!-- Modal Rejected -->
                                    <x-modal name="confirm-pembelian-rejected-{{ $data->id }}" focusable>
                                        <form method="post" action="{{ route('pembelian.rejected', $data->id) }}" class="p-6">
                                            @csrf
                                            @method('PATCH')
                                            <h2 class="text-lg font-medium text-gray-400">
                                                {{ __('Pembelian Gagal') }}
                                            </h2>
                                            <p class="mt-1 text-sm text-gray-500">
                                                {{ __('Anda akan menggagalkan pembelian, maka "STATUS" pada data akan berubah jadi "Gagal". Silahkan klik tombol "Setujui" untuk Mengagalkan pembelian.') }}
                                            </p>
                                            <div class="my-4">
                                                <label for="note" class="block text-left mb-2 text-sm font-medium text-gray-900 dark:text-white">catatan pengagalan</label>
                                                <textarea id="note" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Tuliskan alasan anda..." name="note"></textarea>
                                            </div>
                                            <div class="mt-6 flex justify-end">
                                                <x-secondary-button x-on:click="$dispatch('close')">
                                                    {{ __('Kembali') }}
                                                </x-secondary-button>
                                                <x-primary-button class="ms-3">
                                                    {{ __('Setujui') }}
                                                </x-primary-button>
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
                    {{ $pembelian->links() }}
                </div>
            </div>
        </div>

    </div>
    <script>
        function showInput() {
            const periode = document.getElementById('periode').value;
            const inputContainer = document.getElementById('input-container');
            let inputHTML = '';

            if (periode === 'hari') {
                inputHTML = `
                <input type="date" name="tanggal" class="block w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" required>
            `;
            } else if (periode === 'minggu') {
                inputHTML = `
                <input type="week" name="tanggal" class="block w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" required>
            `;
            } else if (periode === 'bulan') {
                inputHTML = `
                <input type="month" name="tanggal" class="block w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" required>
            `;
            } else if (periode === 'tahun') {
                inputHTML = `
                <input type="number" name="tanggal" min="1900" max="2100" class="block w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" required>
            `;
            }

            inputContainer.innerHTML = inputHTML;
        }

        // Initialize input based on the default selection
        document.addEventListener('DOMContentLoaded', showInput);

    </script>



</x-app-layout>
