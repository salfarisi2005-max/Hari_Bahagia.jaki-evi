<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class GuestController extends Controller
{
    public function index(): View
    {
        return view('admin.guests.index', [
            'guests' => Guest::query()->latest()->paginate(20),
            'categories' => Guest::CATEGORIES,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        Guest::query()->create($this->validatedGuest($request));

        return back()->with('status', 'Tamu berhasil ditambahkan.');
    }

    public function update(Request $request, Guest $guest): RedirectResponse
    {
        $guest->update($this->validatedGuest($request));

        return back()->with('status', 'Data tamu berhasil diperbarui.');
    }

    public function destroy(Guest $guest): RedirectResponse
    {
        $guest->delete();

        return back()->with('status', 'Tamu berhasil dihapus.');
    }

    /**
     * @return array{name: string, category: string}
     */
    private function validatedGuest(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'category' => ['required', 'string', Rule::in(array_keys(Guest::CATEGORIES))],
        ]);
    }
}
