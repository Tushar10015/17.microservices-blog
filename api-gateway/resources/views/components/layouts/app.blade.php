<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Microservices Blog</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body>
    <div class="container">
        @if (session()->has('token'))
        <div class="fixed right-0 top-0 m-4">
            <livewire:logout-button />
        </div>
        @endif
        @yield('content')
    </div>
    @livewireScripts
</body>

</html>