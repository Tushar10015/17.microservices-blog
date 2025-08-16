<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AuthLogin extends Component
{
    public $email = 'tushar@example.com';
    public $password = 'password';
    public $message = '';

    public function login()
    {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        Log::info('Logging in with email: ' . $this->email);

        $response = Http::post(env('AUTH_SERVICE_URL') . '/api/login', [
            'email' => $this->email,
            'password' => $this->password,
        ]);

        if ($response->successful()) {
            $this->message = 'Login successful!';
            session(['token' => $response->json('token')]);
            return redirect('/posts');
        } else {
            $this->message = 'Invalid credentials';
            Log::error('Login failed for email: ' . $this->email);
        }
    }

    public function render()
    {
        return view('livewire.auth-login');
    }
}
