@extends('layouts.admin')

@section('title', 'Login Admin')

@section('content')
    <main class="flex min-h-screen items-center justify-center px-5 py-12">
        <section class="batik-panel w-full max-w-md rounded-3xl p-8 md:p-10">
            <a href="/" class="text-xs font-semibold uppercase tracking-[0.2em] text-gold-700">Zaki & Evi</a>
            <h1 class="mt-4 font-serif text-3xl font-bold text-stone-900">Login Admin</h1>
            <p class="mt-2 text-sm text-stone-600">Masuk untuk mengelola daftar tamu dan ucapan.</p>

            @if ($errors->any())
                <div class="mt-6 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-800" role="alert">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login.store') }}" class="mt-8 space-y-5">
                @csrf
                <div>
                    <label for="email" class="mb-2 block text-sm font-semibold text-stone-700">Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                        class="w-full rounded-xl border border-stone-200 px-4 py-3 text-sm" placeholder="Email admin">
                </div>
                <div>
                    <label for="password" class="mb-2 block text-sm font-semibold text-stone-700">Kata sandi</label>
                    <input id="password" name="password" type="password" required autocomplete="current-password"
                        class="w-full rounded-xl border border-stone-200 px-4 py-3 text-sm" placeholder="Kata sandi">
                </div>
                <button type="submit" class="w-full rounded-xl bg-stone-900 px-5 py-3 text-sm font-semibold text-amber-100 transition hover:bg-stone-800">
                    Masuk
                </button>
            </form>

            <a href="/" class="mt-6 inline-block text-sm text-stone-500 transition hover:text-gold-700">Kembali ke undangan</a>
        </section>
    </main>
@endsection
