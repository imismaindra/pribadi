<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Login — Maulana Ismaindra</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=DM+Mono:wght@400;500&family=DM+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet"
    >

    @vite(['resources/css/admin.css', 'resources/js/app.js'])
</head>

<body>

    <main class="admin-login-wrap">

        <div class="admin-login-card">

            <a href="{{ url('/') }}" class="admin-brand">
                <span class="admin-brand-mark">MI</span>
                <span class="admin-brand-text">Studio — Admin</span>
            </a>

            <div class="admin-eyebrow">
                ADMIN / 01
            </div>

            <h1>
                Welcome back.
            </h1>

            <p class="admin-login-sub">
                Sign in to manage your portfolio projects.
            </p>

            @if ($errors->any())
                <div class="admin-alert admin-alert-error">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login.submit') }}" class="admin-login-form">

                @csrf

                <div class="admin-field">
                    <label for="email">
                        Email
                    </label>

                    <input
                        type="email"
                        name="email"
                        id="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                    >
                </div>

                <div class="admin-field">
                    <label for="password">
                        Password
                    </label>

                    <input
                        type="password"
                        name="password"
                        id="password"
                        required
                    >
                </div>

                <button
                    type="submit"
                    class="admin-button admin-button-primary"
                >
                    Sign in →
                </button>

            </form>

            <a href="{{ url('/') }}" class="admin-login-back">
                ← Back to portfolio
            </a>

        </div>

    </main>

</body>
</html>
