@extends('layouts.admin')

@section('title', 'Kelola Ucapan')

@section('content')
    <main class="mx-auto min-h-screen max-w-6xl px-5 py-10 md:px-8">
        <header class="mb-8 flex flex-wrap items-center justify-between gap-4">
            <div>
                <a href="{{ route('admin.dashboard') }}" class="text-sm font-semibold text-gold-700">← Dashboard</a>
                <h1 class="mt-3 font-serif text-3xl font-bold text-stone-900">Ucapan & Doa</h1>
            </div>
            <form method="POST" action="{{ route('admin.logout') }}">@csrf<button class="rounded-xl border border-stone-200 bg-white px-4 py-2 text-sm">Keluar</button></form>
        </header>

        @if (session('status'))
            <p class="mb-5 rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-sm text-emerald-800" role="status">{{ session('status') }}</p>
        @endif

        @if ($errors->any())
            <p class="mb-5 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-800" role="alert">{{ $errors->first() }}</p>
        @endif

        <section class="space-y-4">
            @forelse ($wishes as $wish)
                <article class="batik-panel rounded-2xl p-5">
                    <form id="wish-{{ $wish->id }}" method="POST" action="{{ route('admin.wishes.update', $wish) }}" class="grid gap-4 md:grid-cols-[1fr_1fr]">
                        @csrf
                        @method('PUT')
                        <div>
                            <label for="wish-name-{{ $wish->id }}" class="mb-2 block text-xs font-semibold uppercase text-stone-600">Nama</label>
                            <input id="wish-name-{{ $wish->id }}" name="name" value="{{ $wish->name }}" required maxlength="100" class="w-full rounded-lg border border-stone-200 px-3 py-2 text-sm">
                        </div>
                        <div>
                            <label for="wish-category-{{ $wish->id }}" class="mb-2 block text-xs font-semibold uppercase text-stone-600">Kategori</label>
                            <select id="wish-category-{{ $wish->id }}" name="category" class="w-full rounded-lg border border-stone-200 px-3 py-2 text-sm">
                                @foreach ($categories as $value => $label)
                                    <option value="{{ $value }}" @selected($wish->category === $value)>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="md:col-span-2">
                            <label for="wish-message-{{ $wish->id }}" class="mb-2 block text-xs font-semibold uppercase text-stone-600">Ucapan & doa</label>
                            <textarea id="wish-message-{{ $wish->id }}" name="message" rows="3" required maxlength="1000" class="w-full rounded-lg border border-stone-200 px-3 py-2 text-sm">{{ $wish->message }}</textarea>
                        </div>
                    </form>
                    <div class="mt-4 flex flex-wrap gap-2">
                        <button type="submit" form="wish-{{ $wish->id }}" class="rounded-lg bg-stone-900 px-4 py-2 text-xs font-semibold text-amber-100">Simpan perubahan</button>
                        <form method="POST" action="{{ route('admin.wishes.destroy', $wish) }}" onsubmit="return confirm('Hapus ucapan ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="rounded-lg border border-red-200 px-4 py-2 text-xs font-semibold text-red-700">Hapus ucapan</button>
                        </form>
                    </div>
                </article>
            @empty
                <p class="batik-panel rounded-2xl p-8 text-center text-sm text-stone-500">Belum ada ucapan untuk dikelola.</p>
            @endforelse
        </section>

        <div class="mt-6">{{ $wishes->links() }}</div>
    </main>
@endsection
