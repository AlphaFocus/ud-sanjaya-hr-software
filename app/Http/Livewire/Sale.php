<?php

namespace App\Http\Livewire;

use App\Models\Route;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Sale as ModelsSale;
use Illuminate\Support\Facades\DB;

class Sale extends Component
{
    use WithPagination; 
    public $updateState = 0;
    public $search;

    public $quantity;
    public $route;

    public $saleId;


    protected $listeners = [
        'addSale' => '$refresh',
        'deleteConfirmed' => 'delete'
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $routes = Route::all();
        $sales = ModelsSale::with('route')->where('quantity', 'like', '%'.$this->search.'%')
        ->orWhere('route_id', 'like', '%'.$this->search.'%')
        ->orderBy('created_at', 'desc')->paginate(7);

        return view('livewire.sale', compact('sales', 'routes'));
    }

    public function update($saleId)
    {
        $sale = ModelsSale::find($saleId);
        $this->updateState = $saleId;
        $this->quantity = $sale->quantity;
        $this->route = $sale->route->id;
    }

    public function save($saleId)
    {
        $sale = ModelsSale::find($saleId);

        $sale->quantity = $this->quantity;
        $sale->route_id = $this->route;
        $sale->save();

        $this->updateState = 0;
        $this->dispatchBrowserEvent('updated');
    }

    public function deleteModal($saleId)
    {
        $this->saleId = $saleId;
        $this->dispatchBrowserEvent('delete-confirmation');
    }

    public function delete()
    {
        ModelsSale::findOrFail($this->saleId)->delete();

        $this->dispatchBrowserEvent('deleted');
        // dd('$this->userId');
    }
}
