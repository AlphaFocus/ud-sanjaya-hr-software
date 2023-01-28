<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class IndexUser extends Component
{
    public $userId;
    public $search;
    public $updateState;

    public $name;
    public $email;


    use WithPagination;

    protected $listeners = [
        'create-user' => '$refresh',
        'deleteConfirmed' => 'delete',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $users = User::where('name', 'like', '%'.$this->search.'%')
                    ->orwhere('email', 'like', '%'.$this->search.'%')
                    ->orwhere('id', 'like', '%'.$this->search.'%')
                    ->orderBy('created_at', 'desc')
                    ->paginate(7);
                    // ->except(Auth::user()->id);

        $me = Auth::user();
        return view('livewire.index-user', compact('users', 'me'));
    }

    public function update($userId)
    {
        $this->updateState = $userId;
        
        $user = User::find($userId);

        $this->name = $user->name;
        $this->email = $user->email;
    }

    public function save($userId)
    {
        $user = User::find($userId);

        $user->name = $this->name;
        $user->email = $this->email;
        $user->save();

        $this->updateState = 0;
        $this->dispatchBrowserEvent('updated');
    }

    public function cancel()
    {
        $this->updateState = 0;
    }

    public function deleteModal($userId)
    {
        $this->userId = $userId;
        $this->dispatchBrowserEvent('delete-confirmation');
        // dd($this->userId);
    }

    public function delete()
    {
        User::findOrFail($this->userId)->delete();

        $this->dispatchBrowserEvent('deleted');
        // dd('$this->userId');
    }
}
