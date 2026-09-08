<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Login — Maulana Ismaindra</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    <main class="min-h-screen flex items-center justify-center px-6">

        <div class="w-full max-w-md">

            <div class="mb-10">
                <div class="mono text-sm mb-4">
                    ADMIN / 01
                </div>

                <h1 class="text-4xl font-semibold tracking-tight">
                    Welcome back.
                </h1>

                <p class="mt-3 text-gray-500">
                    Sign in to manage your portfolio projects.
                </p>
            </div>

            @if ($errors->any())
                <div class="mb-6 p-4 border border-red-300 text-red-600 text-sm">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login.submit') }}" class="space-y-6">

                @csrf

                <div>
                    <label for="email" class="block text-sm font-medium mb-2">
                        Email
                    </label>

                    <input
                        type="email"
                        name="email"
                        id="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        class="w-full border border-gray-300 px-4 py-3 outline-none focus:border-black"
                    >
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium mb-2">
                        Password
                    </label>

                    <input
                        type="password"
                        name="password"
                        id="password"
                        required
                        class="w-full border border-gray-300 px-4 py-3 outline-none focus:border-black"
                    >
                </div>

                <button
                    type="submit"
                    class="w-full bg-black text-white px-4 py-3 hover:opacity-80 transition"
                >
                    Sign in →
                </button>

            </form>

            <div class="mt-8">
                <a href="{{ url('/') }}" class="mono text-sm hover:underline">
                    ← Back to portfolio
                </a>
            </div>

        </div>

    </main>

</body>
</html>