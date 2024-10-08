<x-app-layout>


    <x-slot name="header">
        {{ __('Daftar Divisi') }}
    </x-slot>

    <div class="p-4 bg-white dark:bg-gray-800 rounded-lg shadow-xs">
        <!-- Start coding here -->
        <div class="relative mb-4 bg-gray-200 shadow-md dark:bg-gray-700 sm:rounded-lg">
            <div class="flex flex-col items-center justify-between p-4 space-y-3 md:flex-row md:space-y-0 md:space-x-4">

                <div class="flex flex-col items-stretch justify-end flex-shrink-0 w-full space-y-2 md:w-auto md:flex-row md:space-y-0 md:items-center md:space-x-3">
                    <button type="button" class="flex px-4 py-2 text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm text-center">
                        <svg class="h-3.5 w-3.5 mt-1 mr-2" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path clip-rule="evenodd" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                        </svg>
                        <a href="{{ route('divisi.create') }}">Tambah Data</a>
                    </button>

                </div>
            </div>
        </div>

        <div class="w-full overflow-hidden rounded-lg shadow-xs ">
            <div class="w-full overflow-x-auto mb-8 rounded-lg shadow-md">
                <table class="w-full whitespace-no-wrap bg-gray-100 dark:bg-gray-600">
                    <thead>
                        <tr class="text-xs font-semibold tracking-wide text-center bg-gray-200 text-gray-500 uppercase border-b dark:border-gray-600 dark:text-gray-400 dark:bg-gray-700">
                            <th class="pr-0 py-3">No</th>
                            <th class="px-4 py-3">Name</th>
                            <th class="px-4 py-3">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-xs font-semibold tracking-wide text-center bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300">
                        @if ($divisi->count() > 0)
                        @foreach($divisi as $data)
                        <tr class="border-b border-gray-200 dark:border-gray-600">
                            <td class="px-0 py-3">{{ $loop->iteration }}</td>
                            <td class="px-4 py-3">{{ $data->nama_divisi }}</td>
                            <td class="px-4 py-3">
                                <div class="flex justify-center space-x-1">
                                    <!-- Modal Trigger -->
                                    <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-divisi-deletion-{{ $data->id }}')" class="flex items-center px-2 py-2 text-sm font-medium text-red-700 bg-white-700 rounded-lg dark:text-gray-500 hover:dark:text-red-700 focus:outline-none focus:shadow-outline-gray">
                                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                        </svg>
                                    </button>
                                    <!-- Modal -->
                                    <x-modal name="confirm-divisi-deletion-{{ $data->id }}" focusable>
                                        <form method="post" action="{{ route('divisi.destroy', $data->id) }}" class="p-6">
                                            @csrf
                                            @method('delete')
                                            <h2 class="text-lg font-medium text-gray-400">
                                                {{ __('Apakah anda yakin ingin menghapus data divisi ini?') }}
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
                <div class="px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase bg-gray-200 dark:bg-gray-700  sm:grid-cols-9">
                    {{ $divisi->links() }}
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
