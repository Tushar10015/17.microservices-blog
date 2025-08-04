@extends('components.layouts.app')
@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div class="flex flex-col p-6 bg-white dark:bg-[#161615] rounded-lg">
        <h1 class="mb-1 font-medium text-4xl">Welcome to Microservices Blog</h1>
        <p class="text-[#706f6c] dark:text-[#A1A09A]">
            This is a simple blog application built with Laravel and Livewire.
            It uses a microservices architecture, with each service responsible for a different part of the application.
        </p>
    </div>
</div>
@endsection