<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'full_text' => fake()->paragraph(50, true),
            'category_id' => Category::all()->random()->id,
            'author_id' => User::all()->random()->id,
            // 'image' => fake()->imageUrl(300, 300),
            'image' => null,
        ];
    }
}
