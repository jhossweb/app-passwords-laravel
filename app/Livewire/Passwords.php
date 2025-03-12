<?php

namespace App\Livewire;

use App\Livewire\Forms\Password\PasswordForm;
use App\Models\Passwords as ModelsPasswords;
use App\Services\ServicePassword;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Passwords extends Component
{
    public $password_input = "";
    public $vissible = false;
    public $password_new = "";

    public PasswordForm $passwordForm;

    function __construct(
        protected ServicePassword $servicePassword = new ServicePassword
    ){}

    function openModal () 
    {
        $this->vissible =  true;
    }

    function genPasswords() {
        $longitud = 16;
        $caracteres = env('PASSWORD_CHARACTERS', 'default_characters_if_not_set');
        $longitudCaracteres = strlen($caracteres);
        $contraseña = '';
        for ($i = 0; $i < $longitud; $i++) {
            $contraseña .= $caracteres[random_int(0, $longitudCaracteres - 1)];
        }

        return $contraseña;
    }


    /** Métodos de base de datos */
    function mount () {
        $this->password_input = $this->servicePassword->generate();
        $this->passwordForm->gen_password = $this->password_input;
        $this->passwordForm->user_id = Auth::id();
    }

    function save() {
        $this->validate();
        $this->passwordForm->save();
        $this->vissible = false;
    }

    function delete( int|string $id ) {
        $passDelete = $this->passwordForm->delete($id);

        if(!$passDelete) session()->flash("error", "No se pudo eliminar la contraseña");

        session()->flash("message", "Contraseña eliminada");
    }
    
    public function render()
    {
        
        $passwords = ModelsPasswords::all();
        return view('livewire.passwords', compact('passwords'));
    }
}
