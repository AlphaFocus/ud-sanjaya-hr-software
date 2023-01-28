<div class="p-4">
    <h1 class="block mb-2 font-bold text-gray-700 text-md">
        Tambah Produksi
    </h1>
    <form action="" wire:submit.prevent="createProd">
        <div class="w-full mb-2">
            <input wire:model="prodModel" class="w-full mt-2 border border-gray-300 rounded-md shadow-md focus:outline-none focus:shadow-outline focus:ring-0" id="produksi" type="number" placeholder="Jumlah produksi" name="produksi">
        </div>
        
        <button type="submit" class="w-full px-4 py-2 mt-2 text-sm font-medium transition duration-200 bg-blue-500 rounded-md shadow-md hover:bg-blue-600 focus:outline-none text-white">Simpan</button>
    </form>
</div>