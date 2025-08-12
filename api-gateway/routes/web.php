<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Posts;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['token.auth'])->group(function () {
    Route::get('/posts', function () {
        return view('posts');
    });
});
