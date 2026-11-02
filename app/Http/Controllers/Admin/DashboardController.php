<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guest;
use App\Models\Wish;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('admin.dashboard.index', [
            'guestCount' => Guest::query()->count(),
            'wishCount' => Wish::query()->count(),
            'recentWishes' => Wish::query()->latest()->limit(5)->get(),
        ]);
    }
}
