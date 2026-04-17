<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Demo account
        User::create([
            'name' => 'Jonathan Whisker',
            'email' => 'whisker@gmail.com',
            'password' => 'Whisker1.', // auto-hashed (Laravel cast)
            'email_verified_at' => now(),
        ]);

        // Other users
        User::create([
            'name' => 'Jean Pierre',
            'email' => 'jp@example.com',
            'password' => 'password',
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Xylo Smith',
            'email' => 'xs@example.com',
            'password' => 'password',
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Holly Farque',
            'email' => 'hf@example.com',
            'password' => 'password',
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Saturnino',
            'email' => 'stonino@example.com',
            'password' => 'password',
            'email_verified_at' => now(),
        ]);
    }
}