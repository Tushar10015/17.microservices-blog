<?php

namespace App\Livewire;

use Livewire\Component;

class AuthTabs extends Component
{
    public $showLogin = true;

    public function render()
    {
        return view('livewire.auth-tabs', [
            'showLogin' => $this->showLogin
        ]);
    }
}
