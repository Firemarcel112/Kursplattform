<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class ProductionSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::firstOrCreate([
            'name' => 'admin',
            'password' => 'admin123',
            'email' => config('mail.from.address'),
            'email_verified_at' => now(),
        ]);
    }
}
