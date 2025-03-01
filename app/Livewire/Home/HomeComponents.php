<?php

namespace App\Livewire\Home;

use Livewire\Component;

class HomeComponents extends Component
{
    public $password;
    public $showPassword = false;
    public $attempts = 0;
    public $maxAttempts = 3;

    function generatePassword () {
        
        if($this->attempts < $this->maxAttempts) {
            $this->password = $this->generatedRandomPassword();
            
            $this->attempts++;
        }

    }

    function mount () {
        if($this->attempts < $this->maxAttempts) {
            $this->password = $this->generatedRandomPassword();
            
            $this->attempts++;
        }
    }

    function generatedRandomPassword () {
        $longitud = 16;
        $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()_+';
        $longitudCaracteres = strlen($caracteres);
        $contraseña = '';
        for ($i = 0; $i < $longitud; $i++) {
            $contraseña .= $caracteres[random_int(0, $longitudCaracteres - 1)];
        }
        
        return $contraseña;
    }

    function toggleShowPassword() {
        $this->showPassword = !$this->showPassword;
    }

    public function render()
    {
        return view('livewire.home.home-components');
    }
}
