<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Microservices Blog</title>
    @livewireStyles
</head>

<body>
    <header class="text-center p-4">
        <h1 class="text-4xl">Microservices Blog</h1>
    </header>

    <div class="container">
        @yield('content')
    </div>

    @livewireScripts
</body>

</html>