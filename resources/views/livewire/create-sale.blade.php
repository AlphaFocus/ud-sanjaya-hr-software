<div class="p-4 bg-white">
    <form wire:submit.prevent="addSale" class="flex flex-col space-y-4">

        {{-- Name --}}
        <div>
            <label class="block text-sm font-bold text-gray-700" for="quantity">
                Penjualan
            </label>
            <input wire:model="quantity" class="w-full border border-gray-300 rounded-md shadow-md focus:outline-none focus:shadow-outline focus:ring-0" id="quantity" type="number" placeholder="Jumlah penjualan" name="quantity">
                @error('quantity')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                @enderror
        </div>

        {{-- Email --}}
        <div>
            <label class="text-sm font-bold text-gray-700" for="route">Rute</label>
            {{-- <input wire:model="route" class="w-full border border-gray-300 rounded-md shadow-md focus:outline-none focus:shadow-outline focus:ring-0" type="text" id="route" placeholder="Rute Penjualan" name="route"> --}}
            <select wire:model="route_id" name="" id="" class="block w-full border border-gray-300 rounded-md shadow-md focus:outline-none focus:shadow-outline focus:ring-0">
                <option class="text-gray-500">Pilih rute...</option>
                @foreach ($routes as $route)
                    <option class="text-black" value="{{ $route->id }}">{{ $route->route }}</option>
                @endforeach
            </select>
                @error('route_id')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                @enderror
        </div>

        {{-- Button --}}
        <div>
            <button type="submit" class="w-full p-2 px-3 text-sm font-medium text-white bg-blue-500 rounded-md shadow-md hover:bg-blue-600 focus:outline-none focus:ring-0 focus:bg-blue-700 transform transition duration-200">
                Tambah Penjualan
            </button>
        </div>

    </form>

    <script>
        window.addEventListener('swal', function(e){
                Swal.fire(e.detail);
        });
    </script>
</div> 