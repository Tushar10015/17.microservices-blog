<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    // GET /api/comments?post_id=1
    public function index(Request $request)
    {
        $request->validate([
            'post_id' => 'required|integer',
        ]);

        $comments = Comment::where('post_id', $request->post_id)->get();
        return response()->json($comments);
    }

    // POST /api/comments
    public function store(Request $request)
    {
        $request->validate([
            'post_id' => 'required|integer',
            'content' => 'required|string',
        ]);

        $user = $request->get('auth_user'); // Data from auth-service

        $comment = Comment::create([
            'post_id' => $request->post_id,
            'user_id' => $user['id'],
            'content' => $request->content,
        ]);

        return response()->json($comment, 201);
    }
}
