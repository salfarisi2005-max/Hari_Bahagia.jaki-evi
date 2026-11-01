@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-stone-900 px-4 py-12 relative overflow-hidden">
    <!-- Ornaments Background -->
    <div class="absolute inset-0 bg-ornament pointer-events-none opacity-20"></div>

    <div class="max-w-md w-full bg-stone-800/90 backdrop-blur-md rounded-2xl shadow-2xl p-8 border border-gold-500/30 relative z-10">
        <div class="text-center mb-8">
            <h2 class="font-serif text-3xl font-bold text-gold-300 mb-2">Login Admin</h2>
            <p class="text-xs text-stone-400">Silakan masuk untuk mengelola ucapan & doa</p>
        </div>

        @if($errors->any())
            <div class="bg-red-500/10 border border-red-500/30 text-red-400 text-xs p-3 rounded-lg mb-6">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-5">
            @csrf
            <div>
                <label class="block text-xs font-semibold uppercase text-gold-300 mb-2">Email Address</label>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="admin@wedding.com" class="w-full px-4 py-3 bg-stone-900/60 border border-stone-700 rounded-xl text-white placeholder-stone-500 focus:outline-none focus:border-gold-500 text-sm">
            </div>

            <div>
                <label class="block text-xs font-semibold uppercase text-gold-300 mb-2">Password</label>
                <input type="password" name="password" required placeholder="••••••••" class="w-full px-4 py-3 bg-stone-900/60 border border-stone-700 rounded-xl text-white placeholder-stone-500 focus:outline-none focus:border-gold-500 text-sm">
            </div>

            <button type="submit" class="w-full py-3.5 bg-gradient-to-r from-gold-700 via-gold-500 to-gold-700 text-stone-900 font-bold text-sm rounded-xl shadow-lg hover:brightness-110 transition duration-300">
                Masuk ke Dashboard
            </button>
        </form>

        <div class="mt-8 text-center">
            <a href="{{ route('wedding.index') }}" class="text-xs text-stone-400 hover:text-gold-300 transition">
                ← Kembali ke Halaman Utama
            </a>
        </div>
    </div>
</div>
@endsection