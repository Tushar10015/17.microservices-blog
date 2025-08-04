<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/rg', function () {
    return view('livewire.auth-register');
});

Route::get('/lg', function () {
    return view('livewire.auth-login');
});
