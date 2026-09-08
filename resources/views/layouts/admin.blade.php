<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Admin — Maulana Ismaindra' }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=DM+Mono:wght@400;500&family=DM+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet"
    >

    @vite(['resources/css/admin.css', 'resources/js/app.js'])
</head>

<body>

    <main class="admin-container">

        @yield('content')

    </main>

</body>
</html>