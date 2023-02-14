<div class="flex flex-col space-y-4 h-full p-2">
    {{-- Controller --}}
    <div class="flex w-full flex-row lg:justify-between space-x-2">
        {{-- Search Bar --}}
        <div class="flex-auto text-gray-600">
            <input wire:model="search"
                class="w-full sm:w-1/2 lg:w-1/4 h-10 px-5 pr-16 text-sm bg-white border border-gray-300 rounded-lg focus:outline-none focus:ring-0 {{ $updateState == 0 ? '' : 'cursor-not-allowed' }}"
                type="search" name="search" placeholder="Cari nama/email pegawai..."
                {{ $updateState != 0 ? 'disabled' : '' }}>
        </div>

        <div class="flex flex-row items-center justify-center space-x-1 text-white">
            <button onclick="Livewire.emit('openModal', 'create-user')"
                class="flex flex-row space-x-1 items-center bg-blue-500 rounded-lg hover:bg-blue-600 h-full px-4 text-xs transform transitions duration-200">
                <i class="fas fa-plus"></i>
                <span class="font-semibold hidden sm:flex">Tambah Pegawai</span>
            </button>
        </div>
    </div>

    {{-- Table --}}
    <div
        class="flex flex-wrap justify-center flex-auto h-full space-y-4 overflow-hidden bg-white rounded-xl shadow-md pb-4">
        <table class="w-full divide-y divide-gray-200 rounded-lg table-auto h-fit">
            <thead class="sticky top-0 bg-gray-50">
                <tr>
                    <td scope="col"
                        class="px-6 py-3 text-xs font-medium text-gray-500 uppercase hidden md:table-cell">ID</td>
                    <td scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase flex-auto">Nama</td>
                    <td scope="col"
                        class="hidden px-6 py-3 text-xs font-medium text-gray-500 uppercase sm:table-cell">Email</td>
                    <td scope="col"
                        class="hidden px-6 py-3 text-xs font-medium text-center text-gray-500 uppercase lg:table-cell">
                        Jabatan</td>
                    <td scope="col"
                        class="hidden px-6 py-3 text-xs font-medium text-gray-500 uppercase lg:table-cell">Bergabung
                    </td>
                    <td scope="col" class="px-6 py-3 text-xs font-medium text-center text-gray-500 uppercase">Aksi
                    </td>
                </tr>
            </thead>

            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($users as $user)
                    <tr>
                        <td scope="col" class="px-6 py-4 text-sm text-gray-900 hidden md:table-cell">
                            {{ sprintf('%04d', $user->id) }}
                        </td>
                        <td scope="col" class="px-6 py-4 text-sm text-gray-900 w-fit">
                            <div class="flex flex-row items-center w-full">
                                <div
                                    class="w-8 h-8 overflow-hidden rounded-full mr-4 flex items-center justify-center shrink-0">
                                    <img src="{{ $user->profile_photo_url }}" alt="" class="w-full h-auto">
                                </div>
                                @if ($updateState == $user->id)
                                    <form action="update" wire:submit.prevent="save({{ $user->id }})">
                                        <input type="text" name="name" id="name" wire:model="name"
                                            class="rounded-lg border border-gray-400 focus:outline-none focus:ring-0">
                                    </form>
                                @else
                                    <div class="">{{ $user->name }}</div>
                                @endif
                            </div>
                        </td>
                        <td scope="col" class="hidden px-6 py-4 text-sm text-gray-900 sm:table-cell">
                            @if ($updateState == $user->id)
                                <form action="update" wire:submit.prevent="save({{ $user->id }})">
                                    <input type="text" name="email" id="email" wire:model="email"
                                        class="rounded-lg border border-gray-400 focus:outline-none focus:ring-0">
                                </form>
                            @else
                                {{ $user->email }}
                            @endif
                        </td>
                        <td scope="col"
                            class="items-center justify-center hidden px-6 py-4 text-sm text-gray-900 lg:table-cell">
                            <span
                                class="{{ $user->role === 0 ? 'bg-gray-500' : 'bg-green-500' }}
                                text-white px-2 text-xs rounded-lg justify-center text-center">
                                {{ $user->role === 0 ? 'Pegawai' : 'Admin' }}
                            </span>
                        </td>
                        <td scope="col" class="hidden px-6 py-4 text-sm text-gray-900 lg:table-cell">
                            {{ $user->created_at->translatedFormat('d F Y') }}
                            <span class="text-gray-500 text-xs">{{ $user->created_at->diffForHumans() }}</span>
                        </td>
                        <td scope="col" class="px-6 py-4 space-x-1 text-white">
                            <div class="flex flex-row items-center justify-center space-x-1">
                                @if ($updateState == $user->id)
                                    <button wire:click="save({{ $user->id }})"
                                        class="flex items-center justify-center text-xs transition duration-200 transform bg-blue-500 rounded-lg hover:bg-blue-600 h-7 w-7">
                                        <i class="fas fa-save"></i>
                                    </button>
                                @else
                                    <button wire:click="update({{ $user->id }})"
                                        class="flex items-center justify-center text-xs transition duration-200 transform bg-blue-500 rounded-lg hover:bg-blue-600 h-7 w-7">
                                        <i class="fas fa-pen"></i>
                                    </button>
                                @endif

                                @if ($updateState == $user->id)
                                    <button wire:click="cancel"
                                        class="flex items-center justify-center text-xs transition duration-200 transform bg-gray-500 rounded-lg hover:bg-gray-600 h-7 w-7">
                                        <i class="fas fa-times"></i>
                                    </button>
                                @else
                                    <a href="{{ route('showUser', $user->id) }}">
                                        <button
                                            class="flex items-center justify-center text-xs transition duration-200 transform bg-gray-500 rounded-lg hover:bg-gray-600 h-7 w-7">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </a>
                                @endif

                                @if ($user->id == $me->id)
                                    <span
                                        class="flex items-center justify-center text-xs bg-gray-500 rounded-lg h-7 w-7 cursor-not-allowed">
                                        <i class="fas fa-minus-square"></i>
                                    </span>
                                @else
                                    <button wire:click="deleteModal({{ $user->id }})"
                                        class="flex items-center justify-center text-xs transition duration-200 transform bg-red-500 rounded-lg hover:bg-red-600 h-7 w-7">
                                        <i class="fas fa-minus-square"></i>
                                    </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="self-end">{{ $users->links() }}</div>
    </div>

    {{-- SweetAlert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        window.addEventListener('delete-confirmation', event => {
            Swal.fire({
                title: 'Hapus pegawai?',
                // text: 'Pegawawai akan dihapus...',
                footer: "Pegawai yang telah dihapus tidak dapat dikembalikan",
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
                title: 'Pegawai berhasil dihapus',
                toast: true,
                position: 'top',
                icon: 'error',
                timer: 3000,
                timerProgressBar: true,
                showConfirmButton: false,
            })
        })
    </script>

</div>
