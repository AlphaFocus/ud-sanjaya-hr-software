<?php

namespace App\Http\Livewire;

use App\Models\Production;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class CreateProduction extends ModalComponent
{
    public $user_id;
    public $prodModel;

    public function render()
    {
        return view('livewire.create-production',[
            'prodList' => Production::where('user_id', $this->user_id)->get(),
        ]);

        // return view('livewire.create-production');
    }

    public function createProd()
    {
        Production::create([
            'user_id' => $this->user_id,
            'quantity' => $this->prodModel
        ]);

        $this->prodModel = null;
        $this->emit('prodList');
        $this->closeModal();

        // dd($this->prod);
    }

    public static function modalMaxWidth(): string
    {
        return 'sm';
    }
}