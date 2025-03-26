<?php

namespace App\Livewire\Forms\Password;

use App\Interfaces\PasswordInterface;
use App\Models\Passwords;
use Livewire\Attributes\Validate;
use Livewire\Form;

class PasswordForm extends Form
{
    #[Validate('required|min:5')]
    public $title_site = "";

    #[Validate('url|min:5')]
    public $site_url = "";

    #[Validate('required|min:16')]
    public $gen_password = "";

    #[Validate('required|exists:users,id')]
    public $user_id = "";


    
    function save() {
        $this->validate();

        $passwordSave = Passwords::create(
            $this->only(["title_site", "site_url", "gen_password","user_id"])
        );

        return $passwordSave;
    }


    function delete (int|string $id) {
        $passwordId = Passwords::find($id);

        if(!$passwordId) return false;

        $passwordId->delete();
        return true;
    }
}