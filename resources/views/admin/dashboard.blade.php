<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @include('layouts.batik-theme')
</head>
<body class="batik-page min-h-screen text-stone-800">
    <header class="bg-stone-900 text-white shadow-lg">
        <div class="mx-auto flex max-w-6xl items-center justify-between gap-4 px-4 py-5">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.25em] text-amber-200">Undangan Digital</p>
                <h1 class="mt-1 text-xl font-bold">Dashboard Admin</h1>
            </div>
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button class="rounded-full border border-white/30 px-4 py-2 text-sm transition hover:bg-white/10" type="submit">
                    Keluar
                </button>
            </form>
        </div>
    </header>

    <main class="mx-auto max-w-6xl space-y-8 px-4 py-8">
        @if (session('status'))
            <div class="rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-800" role="status">
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700" role="alert">
                <p class="font-semibold">Periksa kembali data yang dimasukkan.</p>
                <ul class="mt-1 list-inside list-disc">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <section class="batik-panel rounded-2xl p-6 md:p-8">
            <div class="mb-6">
                <p class="text-xs font-semibold uppercase tracking-[0.2em] text-emerald-800">Kelola ucapan</p>
                <h2 class="mt-1 text-xl font-bold text-stone-900">Tambah Ucapan & Doa</h2>
                <p class="mt-1 text-sm text-stone-600">Total {{ $wishes->total() }} ucapan tersimpan.</p>
            </div>

            <form class="grid gap-4 md:grid-cols-[minmax(12rem,1fr)_minmax(18rem,2fr)_auto] md:items-end" method="POST" action="{{ route('admin.wishes.store') }}">
                @csrf
                <div>
                    <label class="mb-1 block text-sm font-medium" for="new-name">Nama</label>
                    <input class="w-full rounded-lg border border-amber-900/20 bg-white px-3 py-2 focus:border-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-700/15" id="new-name" name="name" type="text" value="{{ old('wish_id') ? '' : old('name') }}" maxlength="100" required>
                </div>
                <div>
                    <label class="mb-1 block text-sm font-medium" for="new-message">Ucapan & doa</label>
                    <textarea class="w-full rounded-lg border border-amber-900/20 bg-white px-3 py-2 focus:border-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-700/15" id="new-message" name="message" rows="2" maxlength="1000" required>{{ old('wish_id') ? '' : old('message') }}</textarea>
                </div>
                <button class="rounded-lg bg-emerald-900 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-emerald-800" type="submit">
                    Tambah Ucapan
                </button>
            </form>
        </section>

        <section class="batik-panel rounded-2xl p-6 md:p-8">
            <div class="mb-5">
                <p class="text-xs font-semibold uppercase tracking-[0.2em] text-emerald-800">Daftar ucapan</p>
                <h2 class="mt-1 text-xl font-bold text-stone-900">Ucapan & Doa</h2>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full min-w-[52rem] text-left text-sm">
                    <thead class="border-b border-amber-900/20 text-stone-600">
                        <tr>
                            <th class="px-3 py-3 font-semibold">Nama</th>
                            <th class="px-3 py-3 font-semibold">Ucapan</th>
                            <th class="px-3 py-3 font-semibold">Tanggal</th>
                            <th class="px-3 py-3 font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-amber-900/10">
                        @forelse ($wishes as $wish)
                            <tr class="align-top">
                                <td class="px-3 py-4">
                                    <form id="edit-wish-{{ $wish->id }}" method="POST" action="{{ route('admin.wishes.update', $wish) }}">
                                        @csrf
                                        @method('PUT')
                                        <input name="wish_id" type="hidden" value="{{ $wish->id }}">
                                        <input class="w-40 rounded-lg border border-stone-300 bg-white px-3 py-2 focus:border-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-700/15" name="name" type="text" value="{{ (string) old('wish_id') === (string) $wish->id ? old('name', $wish->name) : $wish->name }}" maxlength="100" aria-label="Nama pengirim" required>
                                    </form>
                                </td>
                                <td class="px-3 py-4">
                                    <textarea class="w-full min-w-64 rounded-lg border border-stone-300 bg-white px-3 py-2 focus:border-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-700/15" form="edit-wish-{{ $wish->id }}" name="message" rows="3" maxlength="1000" aria-label="Isi ucapan" required>{{ (string) old('wish_id') === (string) $wish->id ? old('message', $wish->message) : $wish->message }}</textarea>
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-stone-600">{{ $wish->created_at->format('d M Y') }}</td>
                                <td class="px-3 py-4">
                                    <div class="flex flex-wrap gap-2">
                                        <button class="rounded-lg bg-emerald-900 px-3 py-2 text-xs font-semibold text-white transition hover:bg-emerald-800" type="submit" form="edit-wish-{{ $wish->id }}">
                                            Simpan
                                        </button>
                                        <form method="POST" action="{{ route('admin.wishes.destroy', $wish) }}" onsubmit="return confirm('Hapus ucapan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="rounded-lg border border-red-200 px-3 py-2 text-xs font-semibold text-red-700 transition hover:bg-red-50" type="submit">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="px-3 py-10 text-center text-stone-500" colspan="4">Belum ada ucapan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-6">{{ $wishes->links() }}</div>
        </section>
    </main>
</body>
</html>
