<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Wish;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class WeddingSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Akun Admin Default
        User::updateOrCreate(
            ['email' => 'admin@wedding.com'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('password123'),
            ]
        );

        // 2. Data Dummy Ucapan & Doa
        $sampleWishes = [
            [
                'name' => 'Salman Alfarisi',
                'message' => 'Selamat untuk kedua mempelai! Semoga menjadi keluarga yang sakinah, mawaddah, warahmah. Aamiin.',
            ],

        ];

        foreach ($sampleWishes as $wish) {
            Wish::firstOrCreate($wish);
        }
    }
}