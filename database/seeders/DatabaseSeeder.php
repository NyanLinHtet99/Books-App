<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Book;
use App\Models\UserInfo;
use Illuminate\Database\Seeder;
use Database\Factories\UserInfoFactory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        UserInfo::factory(10)->create();
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        for ($i = 0; $i < 20; $i++) {
            Book::factory()->create([
                'user_id' => rand(1, 10),
            ]);
        }
    }
}
