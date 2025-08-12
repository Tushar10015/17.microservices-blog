<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

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
        $this->loadPosts();
    }

    public function loadPosts()
    {
        $response = Http::withToken($this->token)
            ->get(env('POST_SERVICE_URL') . '/api/posts');

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
            Http::withToken($this->token)
                ->put(env('POST_SERVICE_URL') . '/api/posts/' . $this->postId, $data);
        } else {
            // Create new post
            Http::withToken($this->token)
                ->post(env('POST_SERVICE_URL') . '/api/posts', $data);
        }

        $this->resetForm();
        $this->loadPosts();
    }

    public function edit($id)
    {
        $post = collect($this->posts)->firstWhere('id', $id);
        if ($post) {
            $this->postId = $post['id'];
            $this->title = $post['title'];
            $this->content = $post['content'];
        }
    }

    public function delete($id)
    {
        Http::withToken($this->token)
            ->delete(env('POST_SERVICE_URL') . '/api/posts/' . $id);

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
