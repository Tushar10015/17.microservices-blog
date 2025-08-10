<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth.service')->apiResource('posts', PostController::class);
