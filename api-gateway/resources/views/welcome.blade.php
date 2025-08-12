@extends('components.layouts.app')
@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 dark:bg-gray-900 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <div class="text-center">
            <h1 class="text-4xl font-bold text-gray-900 dark:text-white">Welcome to Microservices Blog</h1>
            <p class="mt-2 text-lg text-gray-600 dark:text-gray-300">
                A simple blog application built with Laravel and Livewire.
            </p>
        </div>

        @livewire('auth-tabs')
    </div>
</div>
@endsection