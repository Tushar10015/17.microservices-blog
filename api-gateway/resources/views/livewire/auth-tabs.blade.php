<div class="bg-white dark:bg-gray-800 p-8 rounded-lg shadow-md">
    <!-- Toggle Buttons -->
    <div class="flex mb-8 border-b border-gray-200 dark:border-gray-700">
        <button
            wire:click="$set('showLogin', true)"
            class="flex-1 py-4 px-1 text-center border-b-2 font-medium text-sm transition-colors duration-200 {{ $showLogin ? 'border-indigo-500 text-indigo-600 dark:border-indigo-400 dark:text-indigo-300' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-200' }}">
            Sign In
        </button>
        <button
            wire:click="$set('showLogin', false)"
            class="flex-1 py-4 px-1 text-center border-b-2 font-medium text-sm transition-colors duration-200 {{ !$showLogin ? 'border-indigo-500 text-indigo-600 dark:border-indigo-400 dark:text-indigo-300' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-200' }}">
            Register
        </button>
    </div>

    <!-- Forms -->
    <div>
        @if($showLogin)
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6 text-center">Sign in to your account</h2>
        @livewire('auth-login')
        <p class="mt-4 text-sm text-gray-600 dark:text-gray-400 text-center">
            Don't have an account?
            <button wire:click="$set('showLogin', false)" class="font-medium text-indigo-600 hover:text-indigo-500 dark:text-indigo-400 dark:hover:text-indigo-300 focus:outline-none transition-colors duration-200 cursor-pointer">
                Register here
            </button>
        </p>
        @else
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6 text-center">Create a new account</h2>
        @livewire('auth-register')
        <p class="mt-4 text-sm text-gray-600 dark:text-gray-400 text-center">
            Already have an account?
            <button wire:click="$set('showLogin', true)" class="font-medium text-indigo-600 hover:text-indigo-500 dark:text-indigo-400 dark:hover:text-indigo-300 focus:outline-none transition-colors duration-200 cursor-pointer">
                Sign in here
            </button>
        </p>
        @endif
    </div>
</div>