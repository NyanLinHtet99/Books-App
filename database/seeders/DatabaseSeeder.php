<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Book;
use App\Models\Comment;
use App\Models\Rating;
use App\Models\Tag;
use App\Models\User;
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
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        Tag::factory(10)->create();
        UserInfo::factory(20)->create();
        // ]);
        for ($i = 0; $i < 40; $i++) {
            $book = Book::factory()
                ->create([
                    'user_id' => rand(1, 10),
                ]);
            $users = User::all();
            foreach ($users as $user) {
                // $book->comments = Comment::factory()->create([
                //     'user_id' => $user->id,
                // ]);
                $book->ratings()->save(Rating::factory()->create([
                    'user_id' => $user->id,
                ]));
                $book->save();
            }
            $count = rand(2, 5);
            for ($j = 0; $j < $count; $j++) {
                $book->tags()->attach(rand(1, 10));
            }
        }
    }
}
