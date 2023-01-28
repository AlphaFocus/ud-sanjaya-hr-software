<?php

namespace App\Http\Livewire;

use App\Models\Route;
use App\Models\Sale;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class CreateSale extends ModalComponent
{
    public $quantity;
    public $route_id;

    public function render()
    {
        $routes = Route::all();
        return view('livewire.create-sale', compact('routes'));
    }

    protected $rules = [
        'quantity' => 'required',
        'route_id' => 'required',
    ];

    protected $messages = [
        'quantity.required' => 'Jumlah penjualan tidak boleh kosong',
        'route_id.required' => 'Rute tidak boleh kosong',
    ];

    public function updated($validate)
    {
        $this->validateOnly($validate);
    }

    public function addSale()
    {
        Sale::create($this->validate());

        $this->quantity = '';
        $this->route_id = '';
        
        $this->dispatchBrowserEvent('swal', [
            'toast' => true,
            'position' => 'top',
            'title' => 'Penjualan berhasil ditambah', 
            'icon' => 'success',
            'timer' => 3000,
            'timerProgressBar' => true,
            'showConfirmButton' => false,
        ]);
        
        $this->emit('addSale');
        $this->closeModal();
    }
}
