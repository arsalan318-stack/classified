<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;

class Navbar extends Component
{
    public $user = [];
    public $text = '';
    

public function clicked(){
   $this->user = User::all();
   session()->flash('success', 'It is successful');
}
    public function render()
    {
        return view('livewire.user.navbar');
    }
}
