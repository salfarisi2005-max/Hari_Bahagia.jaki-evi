<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guest;
use App\Models\Wish;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class WishController extends Controller
{
    public function index(): View
    {
        return view('admin.wishes.index', [
            'wishes' => Wish::query()->latest()->paginate(20),
            'categories' => Guest::CATEGORIES,
        ]);
    }

    public function update(Request $request, Wish $wish): RedirectResponse
    {
        $data = $this->validatedWish($request);
        $data['guest_id'] = Guest::query()
            ->where('name', $data['name'])
            ->where('category', $data['category'])
            ->value('id');

        $wish->update($data);

        return back()->with('status', 'Ucapan berhasil diperbarui.');
    }

    public function destroy(Wish $wish): RedirectResponse
    {
        $wish->delete();

        return back()->with('status', 'Ucapan berhasil dihapus.');
    }

    /**
     * @return array{category: string, name: string, message: string}
     */
    private function validatedWish(Request $request): array
    {
        return $request->validate([
            'category' => ['required', 'string', Rule::in(array_keys(Guest::CATEGORIES))],
            'name' => ['required', 'string', 'max:100'],
            'message' => ['required', 'string', 'max:1000'],
        ]);
    }
}
