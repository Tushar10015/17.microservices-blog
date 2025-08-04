<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AuthLogin extends Component
{
    public $email = '';
    public $password = '';
    public $message = '';

    public function login()
    {
        dd('Method called');


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
            session()->flash('message', 'Login successful!');
            // You might want to store the token in the session or a cookie here
            // session(['auth_token' => $response['token']]);
        } else {
            $this->addError('email', 'Invalid credentials');
            Log::error('Login failed for email: ' . $this->email);
        }
    }

    public function render()
    {
        return view('livewire.auth-login');
    }
}
