@extends('layouts.admin')

@section('title', 'Kelola Tamu')

@section('content')
    <main class="mx-auto min-h-screen max-w-6xl px-5 py-10 md:px-8">
        <header class="mb-8 flex flex-wrap items-center justify-between gap-4">
            <div>
                <a href="{{ route('admin.dashboard') }}" class="text-sm font-semibold text-gold-700">← Dashboard</a>
                <h1 class="mt-3 font-serif text-3xl font-bold text-stone-900">Daftar Tamu</h1>
            </div>
            <form method="POST" action="{{ route('admin.logout') }}">@csrf<button class="rounded-xl border border-stone-200 bg-white px-4 py-2 text-sm">Keluar</button></form>
        </header>

        @if (session('status'))
            <p class="mb-5 rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-sm text-emerald-800" role="status">{{ session('status') }}</p>
        @endif

        @if ($errors->any())
            <p class="mb-5 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-800" role="alert">{{ $errors->first() }}</p>
        @endif

        <form method="POST" action="{{ route('admin.guests.store') }}" class="batik-panel mb-8 grid gap-4 rounded-2xl p-5 md:grid-cols-[1fr_1fr_auto] md:items-end">
            @csrf
            <div>
                <label for="new-guest-name" class="mb-2 block text-sm font-semibold text-stone-700">Nama tamu</label>
                <input id="new-guest-name" name="name" value="{{ old('name') }}" required maxlength="100" class="w-full rounded-xl border border-stone-200 px-4 py-3 text-sm" placeholder="Nama tamu">
            </div>
            <div>
                <label for="new-guest-category" class="mb-2 block text-sm font-semibold text-stone-700">Kategori</label>
                <select id="new-guest-category" name="category" required class="w-full rounded-xl border border-stone-200 px-4 py-3 text-sm">
                    @foreach ($categories as $value => $label)
                        <option value="{{ $value }}" @selected(old('category') === $value)>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="rounded-xl bg-stone-900 px-5 py-3 text-sm font-semibold text-amber-100">Tambah tamu</button>
        </form>

        <section class="batik-panel overflow-hidden rounded-2xl">
            <div class="overflow-x-auto">
                <table class="w-full min-w-[640px] text-left text-sm">
                    <thead class="bg-stone-100 text-stone-700"><tr><th class="px-4 py-3">Nama & kategori</th><th class="px-4 py-3">Tautan undangan</th><th class="px-4 py-3">Aksi</th></tr></thead>
                    <tbody>
                        @forelse ($guests as $guest)
                            <tr class="border-t border-stone-100 align-top">
                                <td class="px-4 py-4">
                                    <form id="guest-{{ $guest->id }}" method="POST" action="{{ route('admin.guests.update', $guest) }}" class="grid gap-2 sm:grid-cols-2">
                                        @csrf
                                        @method('PUT')
                                        <input name="name" value="{{ $guest->name }}" required maxlength="100" class="rounded-lg border border-stone-200 px-3 py-2">
                                        <select name="category" class="rounded-lg border border-stone-200 px-3 py-2">
                                            @foreach ($categories as $value => $label)
                                                <option value="{{ $value }}" @selected($guest->category === $value)>{{ $label }}</option>
                                            @endforeach
                                        </select>
                                    </form>
                                </td>
                                <td class="px-4 py-4"><a href="{{ route('wedding.index', ['to' => $guest->name]) }}" target="_blank" rel="noopener noreferrer" class="font-semibold text-gold-700 hover:underline">Buka undangan ↗</a></td>
                                <td class="px-4 py-4">
                                    <div class="flex flex-wrap gap-2">
                                        <button type="submit" form="guest-{{ $guest->id }}" class="rounded-lg bg-stone-900 px-3 py-2 text-xs font-semibold text-amber-100">Simpan</button>
                                        <form method="POST" action="{{ route('admin.guests.destroy', $guest) }}" onsubmit="return confirm('Hapus tamu ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="rounded-lg border border-red-200 px-3 py-2 text-xs font-semibold text-red-700">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="3" class="px-4 py-10 text-center text-stone-500">Belum ada tamu. Tambahkan tamu lewat formulir di atas.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="border-t border-stone-100 p-4">{{ $guests->links() }}</div>
        </section>
    </main>
@endsection
