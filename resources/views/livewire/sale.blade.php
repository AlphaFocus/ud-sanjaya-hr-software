<div class="w-full flex p-2">

    <div class="flex flex-auto flex-col space-y-4 items-center">
        {{-- Controller --}}
        <div class="flex w-full flex-row lg:justify-between space-x-2">
            {{-- Search Bar --}}
            <div class="flex-auto text-gray-600">
                <input wire:model="search"
                    class="w-full sm:w-1/2 lg:w-1/4 h-10 px-5 pr-16 text-sm bg-white border border-gray-300 rounded-lg focus:outline-none focus:ring-0 {{ $updateState == 0 ? '' : 'cursor-not-allowed' }}"
                    type="search" name="search" placeholder="Cari data penjualan..."
                    {{ $updateState != 0 ? 'disabled' : '' }}>
            </div>
            <div class="flex flex-row items-center justify-center space-x-1 text-white">
                <button onclick="Livewire.emit('openModal', 'create-sale')"
                    class="flex flex-row space-x-1 items-center bg-blue-500 rounded-lg hover:bg-blue-600 h-full px-4 text-xs transform transitions duration-200">
                    <i class="fas fa-plus"></i>
                    <span class="font-semibold hidden sm:flex">Tambah Penjualan</span>
                </button>
            </div>
        </div>
        {{-- Table --}}
        <div class="flex w-full flex-wrap h-full rounded-lg overflow-hidden bg-white justify-center">
            <table class="w-full divide-y divide-gray-200 rounded-lg table-auto h-fit">
                <thead class="sticky top-0 bg-gray-50">
                    <tr>
                        <td scope="col"
                            class="px-6 py-3 text-xs font-medium text-gray-500 uppercase hidden sm:table-cell">ID</td>
                        <td scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase flex-auto">
                            Penjualan</td>
                        <td scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase flex-auto">Rute
                        </td>
                        <td scope="col"
                            class="px-6 py-3 text-xs font-medium text-gray-500 uppercase flex-auto hidden sm:table-cell">
                            Tanggal</td>
                        <td scope="col" class="px-6 py-3 text-xs font-medium text-center text-gray-500 uppercase">
                            Aksi</td>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($sales as $sale)
                        <tr>
                            <td scope="col" class="px-6 py-4 text-sm text-gray-900 hidden sm:table-cell">
                                {{ sprintf('%04d', $sale->id) }}
                            </td>
                            <td scope="col" class="px-6 py-4 text-sm text-gray-900">
                                @if ($updateState == $sale->id)
                                    <form action="update" wire:submit.prevent="save({{ $sale->id }})">
                                        <input type="number" name="quantity" id="quantity" wire:model="quantity"
                                            class="rounded-lg border border-gray-400 focus:outline-none focus:ring-0">
                                    </form>
                                @else
                                    <div class="">{{ $sale->quantity }}</div>
                                @endif

                            </td>
                            <td scope="col" class="px-6 py-4 text-sm text-gray-900">
                                @if ($updateState == $sale->id)
                                    <form action="update" wire:submit.prevent="save({{ $sale->id }})">
                                        <select name="" id="" wire:model="route"
                                            class="rounded-lg border border-gray-400 focus:outline-none focus:ring-0">
                                            @foreach ($routes as $route)
                                                <option value="{{ $route->id }}">{{ $route->route }}</option>
                                            @endforeach
                                        </select>
                                    </form>
                                @else
                                    <div class="">{{ $sale->route->route }}</div>
                                @endif
                            </td>
                            <td scope="col" class="px-6 py-4 text-sm text-gray-900 hidden sm:table-cell">
                                {{ $sale->created_at->translatedFormat('l, d F Y') }}
                                <span
                                    class="text-xs text-gray-400 block">{{ $sale->created_at->diffForHumans() }}</span>
                            </td>
                            {{-- Aksi --}}
                            <td scope="col" class="px-6 py-4 space-x-1 text-white">
                                <div class="flex flex-row items-center justify-center space-x-1">
                                    @if ($updateState == $sale->id)
                                        <button wire:click="save({{ $sale->id }})"
                                            class="flex items-center justify-center text-xs transition duration-200 transform bg-blue-500 rounded-lg hover:bg-blue-600 h-7 w-7">
                                            <i class="fas fa-save"></i>
                                        </button>
                                    @else
                                        <button wire:click="update({{ $sale->id }})"
                                            class="flex items-center justify-center text-xs transition duration-200 transform bg-blue-500 rounded-lg hover:bg-blue-600 h-7 w-7">
                                            <i class="fas fa-pen"></i>
                                        </button>
                                    @endif
                                    <button wire:click="deleteModal({{ $sale->id }})"
                                        class="flex items-center justify-center text-xs transition duration-200 transform bg-red-500 rounded-lg hover:bg-red-600 h-7 w-7">
                                        <i class="fas fa-minus-square"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="self-end">{{ $sales->links() }}</div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        window.addEventListener('delete-confirmation', event => {
            Swal.fire({
                title: 'Hapus data penjualan?',
                // text: 'Pegawawai akan dihapus...',
                footer: "Data penjualan yang telah dihapus tidak dapat dikembalikan",
                icon: 'warning',

                // width: '400px',

                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, saya yakin',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('deleteConfirmed')
                }
            })
        })

        window.addEventListener('updated', event => {
            Swal.fire({
                title: 'Data berhasil diupdate',
                toast: true,
                position: 'top',
                icon: 'success',
                timer: 3000,
                timerProgressBar: true,
                showConfirmButton: false,
            })
        })

        window.addEventListener('deleted', event => {
            Swal.fire({
                title: 'Data penjualan berhasil dihapus',
                toast: true,
                width: "380px",
                position: 'top',
                icon: 'error',
                timer: 3000,
                timerProgressBar: true,
                showConfirmButton: false,
            })
        })
    </script>
</div>
