<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class Home extends Component
{
    public $posts = [];

    public function mount()
    {
        Log::info('Home component mounted');

        $this->posts = [
            ['title' => 'Post 1', 'body' => 'This is the body of post 1'],
            ['title' => 'Post 2', 'body' => 'This is the body of post 2'],
            ['title' => 'Post 3', 'body' => 'This is the body of post 3'],
        ];

        /* $response = Http::get('http://post-service/api/posts');

        if ($response->successful()) {
            $this->posts = $response->json();
        } else {
            $this->posts = [['title' => 'Error', 'body' => 'Could not fetch posts']];
        } */
    }

    public function render()
    {
        Log::info('Home component rendered');
        return view('livewire.home');
    }
}
