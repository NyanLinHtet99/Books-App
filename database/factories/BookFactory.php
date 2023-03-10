<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\UserInfo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory()->has(UserInfo::factory(), 'info'),
            'title' => implode(" ", $this->faker->words(6)),
            'description' => $this->faker->paragraph(),
            'cover' => 'default.jpg',
        ];
    }
}
