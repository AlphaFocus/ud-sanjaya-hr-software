<div class="p-4 bg-white">
    <form wire:submit.prevent="addUser" class="flex flex-col space-y-4">

        {{-- Name --}}
        <div>
            <label class="block text-sm font-bold text-gray-700" for="name">
                Nama
            </label>
            <input wire:model="name" class="w-full border border-gray-300 rounded-md shadow-md focus:outline-none focus:shadow-outline focus:ring-0" id="name" type="text" placeholder="Nama" name="name">
                @error('name')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                @enderror
        </div>

        {{-- Email --}}
        <div>
            <label class="text-sm font-bold text-gray-700" for="email">E-mail</label>
            <input wire:model="email" class="w-full border border-gray-300 rounded-md shadow-md focus:outline-none focus:shadow-outline focus:ring-0" type="text" id="email" placeholder="E-mail" name="email">
                @error('email')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                @enderror
        </div>

        {{-- Password --}}
        <div>
            <label class="text-sm font-bold text-gray-700" for="password">Kata Sandi</label>
            <input wire:model="password" class="w-full border border-gray-300 rounded-md shadow-md focus:outline-none focus:shadow-outline focus:ring-0" type="password" id="password" placeholder="Kata Sandi" name="password">
                @error('password')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                @enderror
        </div>

        {{-- Button --}}
        <div>
            <button type="submit" class="w-full p-2 px-3 text-sm font-medium text-white bg-blue-500 rounded-md shadow-md hover:bg-blue-600 focus:outline-none focus:ring-0 focus:bg-blue-700 transform transition duration-200">
                Tambah Pegawai
            </button>
        </div>

    </form>

    <script>
        window.addEventListener('swal', function(e){
                Swal.fire(e.detail);
        });
    </script>
</div> 