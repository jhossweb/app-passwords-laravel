<?php

namespace App\Services;

class ServicePassword
{
    protected $characters;

    public function __construct() {
        $this->characters = env('PASSWORD_CHARACTERS', 'default_characters_if_not_set');
    }

    public function generate($length = 16) {
        $password = '';
        $charactersLength = strlen($this->characters);
        for ($i = 0; $i < $length; $i++) {
            $password .= $this->characters[random_int(0, $charactersLength - 1)];
        }
        return $password;
    }

}