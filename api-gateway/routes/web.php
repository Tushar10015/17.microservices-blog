<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Posts;



Route::middleware(['token.auth'])->group(function () {

    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/posts', function () {
        return view('posts');
    });
});
