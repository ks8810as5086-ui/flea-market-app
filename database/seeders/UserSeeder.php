<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'TestUser',
            'email' => 'testuser@example.com',
            'password' => Hash::make('password'),
            'profile_image' => 'dummy.jpg',
            'postal_code' => '000-0000',
            'address' => '東京都渋谷区1-1-1',
            'building' => 'テストビル101',
        ]);
    }
}
