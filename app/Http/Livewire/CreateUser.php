<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Facades\Hash;
use LivewireUI\Modal\ModalComponent;

class CreateUser extends ModalComponent
{
    public $name;
    public $email;
    public $password;

    protected $rules = [
        'name' => 'required|min:4|regex:/^[\pL\s\-]+$/u',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:8',
    ];

    protected $messages = [
        'name.required' => 'Nama tidak boleh kosong',
        'name.min' => 'Nama tidak boleh kurang dari 4 karakter',
        'name.regex' => 'Nama tidak boleh mengandung karakter illegal',

        'email.required' => 'E-mail tidak boleh kosong',
        'email.email' => 'Format e-mail harus benar (contoh: email@domain)',
        'email.unique' => 'E-mail sudah digunakan',

        'password.required' => 'Kata Sandi tidak boleh kosong',
        'password.min' => 'Kata Sandi tidak boleh kurang dari 8 karakter',
    ];

    public function render()
    {   
        return view('livewire.create-user');
    }

    public function updated($validate)
    {
        $this->validateOnly($validate);
    }

    public function addUser()
    {   

        User::create($this->validate());

        $this->name = '';
        $this->email = '';
        $this->password = '';
        
        $this->dispatchBrowserEvent('swal', [
            'toast' => true,
            'position' => 'top',
            'title' => 'Data berhasil ditambah', 
            'icon' => 'success',
            'timer' => 3000,
            'timerProgressBar' => true,
            'showConfirmButton' => false,
        ]);
        
        $this->emit('create-user');
        $this->closeModal();

        // $this->body = '';
    }

    public static function modalMaxWidth(): string
    {
        return 'md';
    }
}
