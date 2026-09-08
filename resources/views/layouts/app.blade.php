<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'Maulana Ismaindra — Full-Stack Developer')
    </title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    <div class="cursor"></div>
    <div class="cursor-dot"></div>

    @include('partials.navbar')

    <main>
        @yield('content')
    </main>

    @include('partials.footer')

</body>
</html>