<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'Maulana Ismaindra — Full-Stack Developer')
    </title>

    <meta name="description" content="@yield('description', 'Maulana Ismaindra — Full-Stack Developer. I design, develop, and maintain websites and web-based systems built for real-world use.')">

    <link rel="canonical" href="{{ url()->current() }}">

    <meta property="og:type" content="website">
    <meta property="og:site_name" content="ismaindra.web.id">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', 'Maulana Ismaindra — Full-Stack Developer')">
    <meta property="og:description" content="@yield('description', 'Maulana Ismaindra — Full-Stack Developer. I design, develop, and maintain websites and web-based systems built for real-world use.')">
    <meta property="og:image" content="{{ asset('images/og-image.jpg') }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="Maulana Ismaindra — Full-Stack Developer">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', 'Maulana Ismaindra — Full-Stack Developer')">
    <meta name="twitter:description" content="@yield('description', 'Maulana Ismaindra — Full-Stack Developer. I design, develop, and maintain websites and web-based systems built for real-world use.')">
    <meta name="twitter:image" content="{{ asset('images/og-image.jpg') }}">

    <meta name="theme-color" content="#101417">

    <link rel="icon" href="{{ asset('favicon.ico') }}" sizes="48x48">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">

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