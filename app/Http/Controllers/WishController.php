<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use App\Models\Wish;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class WishController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'category' => ['required', 'string', Rule::in(array_keys(Guest::CATEGORIES))],
            'name' => ['required', 'string', 'max:100'],
            'message' => ['required', 'string', 'max:1000'],
        ]);

        $guestId = Guest::query()
            ->where('name', $data['name'])
            ->where('category', $data['category'])
            ->value('id');

        $wish = Wish::query()->create([
            ...$data,
            'guest_id' => $guestId,
        ]);

        return response()->json(['wish' => $wish], 201);
    }
}
