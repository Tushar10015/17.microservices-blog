@extends('components.layouts.app')
@section('content')
<div class="max-w-md mx-auto mt-10 p-6 bg-white rounded shadow">
    @if (session()->has('message'))
        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
            {{ session('message') }}
        </div>
    @endif
    
    <form wire:submit.prevent="login">
        @csrf
        <h2 class="text-xl font-bold mb-4">Login</h2>

        @isset($message)
        <div class="mb-4 p-2 bg-green-100 text-green-700 rounded">
            {{ $message }}
        </div>
        @endisset

        <div class="mb-4">
            <label>Email</label>
            <input wire:model="email" type="email" class="w-full border p-2 rounded">
            @error('email') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label>Password</label>
            <input wire:model="password" type="password" class="w-full border p-2 rounded">
            @error('password') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
            Login
        </button>
    </form>
</div>
@endsection