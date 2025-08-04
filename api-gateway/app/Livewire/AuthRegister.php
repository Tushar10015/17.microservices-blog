<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class AuthRegister extends Component
{
    public $name = '';
    public $email = '';
    public $password = '';
    public $password_confirmation = '';
    public $message = '';

    public function register()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|confirmed|min:8',
        ]);

        $response = Http::post(env('AUTH_SERVICE_URL') . '/api/register', [
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'password_confirmation' => $this->password_confirmation,
        ]);

        if ($response->successful()) {
            $this->reset(['name', 'email', 'password', 'password_confirmation']);
            $this->message = 'Registration successful! Please login.';
        } else {
            $errors = $response->json('errors') ?? ['email' => ['Registration failed']];
            foreach ($errors as $field => $messages) {
                foreach ((array) $messages as $msg) {
                    $this->addError($field, $msg);
                }
            }
        }
    }

    public function render()
    {
        return view('livewire.auth-register');
    }
}
