@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-stone-100 p-6 md:p-12">
    <div class="max-w-6xl mx-auto">
        <div class="flex justify-between items-center mb-8">
            <h1 class="font-serif text-2xl font-bold text-stone-900">Admin Dashboard - Kelola Ucapan</h1>
            <span class="text-xs font-semibold bg-gold-100 text-gold-700 px-3 py-1 rounded-full">Total: {{ $wishes->total() }}</span>
        </div>

        <div class="bg-white rounded-2xl shadow-md overflow-hidden border border-stone-200">
            <table class="w-full text-left text-sm">
                <thead class="bg-stone-50 border-b border-stone-200 text-xs uppercase text-stone-500">
                    <tr>
                        <th class="p-4">Nama</th>
                        <th class="p-4">Ucapan</th>
                        <th class="p-4">Tanggal</th>
                        <th class="p-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100">
                    @foreach($wishes as $wish)
                    <tr>
                        <td class="p-4 font-semibold text-stone-800">{{ $wish->name }}</td>
                        <td class="p-4 text-stone-600 max-w-md">{{ $wish->message }}</td>
                        <td class="p-4 text-xs text-stone-400">{{ $wish->created_at->format('d M Y H:i') }}</td>
                        <td class="p-4 text-center">
                            <button onclick="deleteWish({{ $wish->id }})" class="px-3 py-1 bg-red-100 text-red-600 hover:bg-red-200 rounded-lg text-xs font-semibold transition">Hapus</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $wishes->links() }}
        </div>
    </div>
</div>

<script>
async function deleteWish(id) {
    if (confirm('Yakin ingin menghapus ucapan ini?')) {
        const response = await fetch(`/api/wishes/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        });
        if (response.ok) {
            location.reload();
        }
    }
}
</script>
@endsection