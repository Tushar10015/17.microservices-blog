<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class LogoutButton extends Component
{
    public function logout()
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . session('token'),
        ])->post(env('AUTH_SERVICE_URL') . '/api/logout');

        if ($response->successful()) {
            session()->forget('token');
            return redirect('/');
        } else {
            $this->addError('message', 'Failed to logout');
        }
    }

    public function render()
    {
        return view('livewire.logout-button');
    }
}
