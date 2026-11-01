<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @include('layouts.batik-theme')
</head>
<body class="batik-page min-h-screen px-4 py-12 text-stone-800">
    <main class="batik-panel mx-auto mt-12 max-w-md rounded-2xl p-8">
        <p class="text-sm font-semibold uppercase tracking-[0.2em] text-emerald-800">Admin Undangan</p>
        <h1 class="mt-2 text-2xl font-bold">Masuk ke Dashboard</h1>
        <p class="mt-2 text-sm text-stone-500">Masukkan email dan password akun admin Anda.</p>

        @if ($errors->any())
            <div class="mt-6 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700" role="alert">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form class="mt-6 space-y-5" method="POST" action="{{ route('admin.login.submit') }}">
            @csrf

            <div>
                <label class="mb-1 block text-sm font-medium" for="email">Email</label>
                <input
                    class="w-full rounded-lg border border-stone-300 bg-white px-3 py-2 focus:border-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-700/15"
                    id="email"
                    name="email"
                    type="email"
                    value="{{ old('email') }}"
                    autocomplete="username"
                    required
                    autofocus
                >
            </div>

            <div>
                <label class="mb-1 block text-sm font-medium" for="password">Password</label>
                <input
                    class="w-full rounded-lg border border-stone-300 bg-white px-3 py-2 focus:border-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-700/15"
                    id="password"
                    name="password"
                    type="password"
                    autocomplete="current-password"
                    required
                >
            </div>

            <button class="w-full rounded-lg bg-emerald-900 px-4 py-3 font-semibold text-white transition hover:bg-emerald-800" type="submit">
                Masuk
            </button>
        </form>
    </main>
</body>
</html>
