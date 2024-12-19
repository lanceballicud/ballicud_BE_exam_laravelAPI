<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $category = Category::inRandomOrder()->first();
        $user = User::inRandomOrder()->first();

        return [
            'name' => fake()->firstName(),
            'category_name' => $category->name,
            'description' => fake()->paragraph(),
            'datetime' => fake()->dateTimeThisYear(),
            'user_id' => $user->id,
        ];
    }
}
