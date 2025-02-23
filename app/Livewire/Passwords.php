<?php

namespace App\Livewire;

use App\Models\Passwords as ModelsPasswords;
use Livewire\Component;

class Passwords extends Component
{
    public $title = "jhossweb";
    
    public function render()
    {
        $passwords = ModelsPasswords::all();
        return view('livewire.passwords', compact('passwords'));
    }
}
