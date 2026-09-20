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

    <header class="admin-topbar">

        <div class="admin-topbar-inner">

            <a href="{{ route('admin.dashboard') }}" class="admin-brand">
                <span class="admin-brand-mark">MI</span>
                <span class="admin-brand-text">Studio — Admin</span>
            </a>

            <nav class="admin-nav">
                <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'is-active' : '' }}">Dashboard</a>
                <a href="{{ route('admin.projects.index') }}" class="{{ request()->routeIs('admin.projects.*') ? 'is-active' : '' }}">Projects</a>
            </nav>

            @auth
            <form method="POST" action="{{ route('admin.logout') }}" class="admin-topbar-logout">
                @csrf
                <button type="submit" class="admin-button admin-button-secondary admin-button-sm">
                    Logout
                </button>
            </form>
            @endauth

        </div>

    </header>

    <main class="admin-container">

        @yield('content')

    </main>

</body>
</html>