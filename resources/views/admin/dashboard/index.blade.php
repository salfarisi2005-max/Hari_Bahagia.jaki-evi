@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <main class="mx-auto min-h-screen max-w-6xl px-5 py-10 md:px-8">
        <header class="mb-10 flex flex-wrap items-center justify-between gap-4">
            <div>
                <a href="/" class="text-xs font-semibold uppercase tracking-[0.2em] text-gold-700">Zaki & Evi</a>
                <h1 class="mt-2 font-serif text-3xl font-bold text-stone-900">Dashboard Undangan</h1>
                <p class="mt-1 text-sm text-stone-600">Kelola tamu dan ucapan dalam satu tempat.</p>
            </div>
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="rounded-xl border border-stone-200 bg-white px-4 py-2.5 text-sm font-semibold text-stone-700 transition hover:border-gold-500">Keluar</button>
            </form>
        </header>

        <section class="grid gap-5 sm:grid-cols-2" aria-label="Ringkasan">
            <a href="{{ route('admin.guests.index') }}" class="batik-panel rounded-2xl p-6 transition hover:-translate-y-1">
                <p class="text-sm text-stone-600">Daftar tamu</p>
                <p class="mt-2 font-serif text-4xl font-bold text-stone-900">{{ $guestCount }}</p>
                <span class="mt-4 inline-block text-sm font-semibold text-gold-700">Kelola tamu →</span>
            </a>
            <a href="{{ route('admin.wishes.index') }}" class="batik-panel rounded-2xl p-6 transition hover:-translate-y-1">
                <p class="text-sm text-stone-600">Ucapan & doa</p>
                <p class="mt-2 font-serif text-4xl font-bold text-stone-900">{{ $wishCount }}</p>
                <span class="mt-4 inline-block text-sm font-semibold text-gold-700">Kelola ucapan →</span>
            </a>
        </section>

        <section class="batik-panel mt-8 rounded-2xl p-6">
            <div class="mb-5 flex flex-wrap items-center justify-between gap-3">
                <h2 class="font-serif text-xl font-bold text-stone-900">Ucapan terbaru</h2>
                <a href="{{ route('admin.wishes.index') }}" class="text-sm font-semibold text-gold-700">Lihat semua</a>
            </div>
            @forelse ($recentWishes as $wish)
                <article class="border-t border-stone-100 py-4 first:border-0">
                    <p class="font-semibold text-stone-900">{{ $wish->name }} <span class="font-normal text-stone-500">· {{ \App\Models\Guest::CATEGORIES[$wish->category] ?? 'Lainnya' }}</span></p>
                    <p class="mt-1 whitespace-pre-wrap text-sm text-stone-600">{{ $wish->message }}</p>
                </article>
            @empty
                <p class="border-t border-stone-100 pt-4 text-sm text-stone-500">Belum ada ucapan.</p>
            @endforelse
        </section>
    </main>
@endsection
