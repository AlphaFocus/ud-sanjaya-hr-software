<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\User;
use Livewire\Component;
use App\Models\Production;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class ShowUser extends Component
{
    use WithPagination;

    public $user_id;
    public $prodId;
    public $search = '';
    public $updateState = 0;

    public $name;
    public $email;

    protected $listeners = [
        'prodList' => '$refresh',
        'deleteConfirmed' => 'delete'
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $role = Auth::user()->role;
        $user = User::find($this->user_id);
        $productions = Production::where('user_id', $this->user_id)
                                    ->where('quantity', 'like', '%'.$this->search.'%')
                                    ->latest()->paginate(8);

        $prod2Week = Production::where('user_id', $this->user_id)->whereBetween('created_at', [Carbon::today()->subWeek(2), Carbon::today()->subWeek()])->sum('quantity');
        $prodWeek = Production::where('user_id', $this->user_id)->whereBetween('created_at', [Carbon::today()->subWeek(), Carbon::now()]);

        
        return view('livewire.show-user', compact('user', 'productions', 'prodWeek', 'prod2Week', 'role'));
    }

    public function showUpdateForm($prodId)
    {
        $this->updateState = $prodId;
        
        $production = Production::find($prodId);
        $this->prodModel = $production->quantity;
    }
    
    public function update($prodId)
    {
        // dd($prodId);
        $production = Production::find($prodId);
        $production->quantity = $this->prodModel;
        $production->save();

        $this->updateState = 0;
        $this->dispatchBrowserEvent('updated');
    }

    public function cancel()
    {
        $this->updateState = 0;
    }

    public function deleteModal($prodId)
    {
        $this->prodId = $prodId;
        $this->dispatchBrowserEvent('delete-confirmation');
        // dd($this->userId);
    }

    public function delete()
    {
        Production::findOrFail($this->prodId)->delete();

        $this->dispatchBrowserEvent('deleted');
        // dd('$this->userId');
    }
}
