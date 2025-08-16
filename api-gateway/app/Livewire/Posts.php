<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class Posts extends Component
{
    public $posts = [];
    public $title = '';
    public $content = '';
    public $postId = null; // For editing
    public $token;

    public function mount()
    {
        $this->token = session('token'); // Token from login
        Log::info('Posts component mounted', ['token' => $this->token]);
        $this->loadPosts();
    }

    public function loadPosts()
    {
        $response = Http::withToken($this->token)
            ->get(env('POST_SERVICE_URL') . '/api/posts');

        Log::info('Posts response', ['response' => $response->json()]);
        $this->posts = $response->successful() ? $response->json() : [];
    }

    public function save()
    {
        $data = [
            'title' => $this->title,
            'content' => $this->content,
        ];

        if ($this->postId) {
            // Update post
            $response = Http::withToken($this->token)
                ->put(env('POST_SERVICE_URL') . '/api/posts/' . $this->postId, $data);
        } else {
            // Create new post
            $response = Http::withToken($this->token)
                ->post(env('POST_SERVICE_URL') . '/api/posts', $data);
        }

        Log::info('Post saved/updated', ['response' => $response->json()]);
        $this->resetForm();
        $this->loadPosts();
    }

    public function edit($id)
    {
        $post = collect($this->posts)->firstWhere('id', $id);
        Log::info('Post edited', ['post' => $post]);
        if ($post) {
            $this->postId = $post['id'];
            $this->title = $post['title'];
            $this->content = $post['content'];
        }
    }

    public function delete($id)
    {
        $response = Http::withToken($this->token)
            ->delete(env('POST_SERVICE_URL') . '/api/posts/' . $id);

        Log::info('Post deleted', ['response' => $response->json()]);
        $this->loadPosts();
    }

    public function resetForm()
    {
        $this->postId = null;
        $this->title = '';
        $this->content = '';
    }

    public function render()
    {
        return view('livewire.posts');
    }
}
