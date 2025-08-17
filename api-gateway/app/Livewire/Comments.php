<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class Comments extends Component
{
    public $postId;
    public $comments = [];
    public $body;
    public $token;

    protected $rules = [
        'body' => 'required|string|max:500',
    ];

    public function mount($postId)
    {
        $this->token = session('token');
        $this->postId = $postId;
        $this->loadComments();
    }

    public function loadComments()
    {
        $response = Http::acceptJson()->withToken($this->token)->get(env('COMMENT_SERVICE_URL') . '/api/comments', [
            'post_id' => $this->postId,
        ]);

        Log::info('Load Comments response', [
            'status' => $response->status(),
            'body' => $response->body(),
        ]);

        if ($response->successful()) {
            $this->comments = $response->json();
        } else {
            $this->comments = [];
        }
    }

    public function addComment()
    {
        Log::info('Adding comment', [
            'token' => $this->token,
            'post_id' => $this->postId,
            'content' => $this->body,
        ]);

        $this->validate();

        $response = Http::acceptJson()->withToken($this->token)->post(env('COMMENT_SERVICE_URL') . '/api/comments', [
            'post_id' => $this->postId,
            'content'    => $this->body,
        ]);

        Log::info('Adding Comment response', [
            'status' => $response->status(),
            'body' => $response->body(),
        ]);

        if ($response->successful()) {
            $this->body = '';
            $this->loadComments();
            session()->flash('message', 'Comment added!');
        } else {
            session()->flash('error', 'Failed to add comment.');
        }
    }

    public function render()
    {
        return view('livewire.comments');
    }
}
