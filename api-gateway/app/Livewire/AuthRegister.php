<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AuthRegister extends Component
{
    public $name = 'tushar';
    public $email = 'tushar@example.com';
    public $password = 'password';
    public $password_confirmation = 'password';
    public $message = '';

    public function register()
    {

        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|confirmed|min:8',
        ]);

        $response = Http::acceptJson()->post(env('AUTH_SERVICE_URL') . '/api/register', [
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'password_confirmation' => $this->password_confirmation,
        ]);

        Log::info('Register response: ' . $response->body());


        if ($response->successful()) {
            $this->reset(['name', 'email', 'password', 'password_confirmation']);
            $this->message = 'Registration successful! Please login.';
            session(['token' => $response->json('token')]);
            // ✅ Instead of full redirect, dispatch event
            $this->dispatch('redirect', url: '/posts');
        } else {
            Log::error('Register failed for email: ' . $this->email);
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
