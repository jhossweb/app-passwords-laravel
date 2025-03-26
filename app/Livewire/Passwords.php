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

    


    /** Métodos de base de datos */
    function mount () {
        
        $this->password_input = $this->servicePassword->generate();
        $this->passwordForm->gen_password = $this->password_input;
        $this->passwordForm->user_id = Auth::id();
    }

    function save() {
        $this->validate();
        $saved = $this->passwordForm->save();
        
        if ($saved) {
            $this->passwordForm->reset();
            $this->vissible = false;
            $this->password_input = $this->servicePassword->generate();
            $this->passwordForm->gen_password = $this->password_input;
            session()->flash("message", "Contraseña Creada");
        } else {
            session()->flash("error", "No se pudo guardar la contraseña.");
        }
    }

    function delete( int|string $id ) {
        $passDelete = $this->passwordForm->delete($id);

        if(!$passDelete) session()->flash("error", "No se pudo eliminar la contraseña");

        session()->flash("message", "Contraseña eliminada");
    }
    
    public function render()
    {
        $passwords = ModelsPasswords::with("user")->where("user_id", Auth::id())->get();
        return view('livewire.passwords', compact('passwords'));
    }
}
