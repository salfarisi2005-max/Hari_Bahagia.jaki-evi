<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class WeddingController extends Controller
{
    public function index(Request $request): View
    {
        $guestName = $request->query('to', 'Tamu Undangan');

        $weddingData = [
            'groom' => [
                'short_name' => 'Zaki',
                'full_name' => 'Zaki Adil Bila Bagi',
                'birth_order' => 'keempat',
                'father' => 'Bapak Mirta',
                'mother' => 'Ibu Mulyati',
            ],
            'bride' => [
                'short_name' => 'Evi Navisa',
                'full_name' => 'Evi Navisa',
                'birth_order' => 'pertama',
                'father' => 'Bapak Dedi',
                'mother' => 'Ibu Anti',
            ],
            'event' => [
                'date' => '2026-11-08',
                'akad' => [
                    'time' => '09:00 - selesai',
                    'location' => 'Pasirtenjo',
                    'address' => 'Kabupaten Pandeglang, Banten',
                    'gmaps' => 'https://maps.app.goo.gl/mRokvhcVZWJWSTar6',
                ],
                'resepsi' => [
                    'time' => '10:00 - selesai',
                    'location' => 'Pasirtenjo',
                    'address' => 'Kabupaten Pandeglang, Banten',
                    'gmaps' => 'https://maps.app.goo.gl/mRokvhcVZWJWSTar6',
                ],
            ],
        ];

        $wishes = [];

        foreach (['groom', 'bride'] as $person) {
            $nameParts = preg_split('/\s+/', trim($weddingData[$person]['full_name']), 3);
            $weddingData[$person]['initials'] = collect($nameParts)
                ->filter()
                ->take(2)
                ->map(fn (string $part): string => mb_strtoupper(mb_substr($part, 0, 1)))
                ->implode('');
        }

        return view('wedding.index', compact('guestName', 'weddingData', 'wishes'));
    }
}
