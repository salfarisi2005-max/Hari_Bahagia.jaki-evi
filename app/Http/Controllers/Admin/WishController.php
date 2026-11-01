<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Wish;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class WishController extends Controller
{
    public function index(): View
    {
        $wishes = Wish::latest()->paginate(15);

        return view('admin.dashboard', compact('wishes'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'message' => ['required', 'string', 'max:1000'],
        ]);

        Wish::create($validated);

        return redirect()
            ->route('admin.dashboard')
            ->with('status', 'Ucapan berhasil ditambahkan.');
    }

    public function update(Request $request, Wish $wish): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'message' => ['required', 'string', 'max:1000'],
        ]);

        $wish->update($validated);

        return redirect()
            ->route('admin.dashboard')
            ->with('status', 'Ucapan berhasil diperbarui.');
    }

    public function destroy(Wish $wish): RedirectResponse
    {
        $wish->delete();

        return redirect()
            ->route('admin.dashboard')
            ->with('status', 'Ucapan berhasil dihapus.');
    }
}
