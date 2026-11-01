<?php

namespace App\Http\Controllers;

use App\Models\Wish;
use Illuminate\Http\Request;

class WishController extends Controller
{
    // API: Ambil semua ucapan (terbaru paling atas)
    public function index()
    {
        $wishes = Wish::latest()->get();
        return response()->json([
            'status' => 'success',
            'data' => $wishes
        ]);
    }

    // API: Simpan ucapan baru via AJAX
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'message' => 'required|string|max:1000',
        ]);

        $wish = Wish::create($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Ucapan berhasil dikirimkan',
            'data' => $wish
        ], 201);
    }

    // API: Hapus ucapan untuk Admin
    public function destroy($id)
    {
        $wish = Wish::findOrFail($id);
        $wish->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Ucapan berhasil dihapus'
        ]);
    }
}