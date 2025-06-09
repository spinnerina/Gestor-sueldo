<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\ExpenseCategories;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Expenses>
 */
class ExpensesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'category_id' => ExpenseCategories::inRandomOrder()->first()->id,
            'amount' => fake()->randomFloat(2, 1000, 10000),
            'expense_date' => fake()->date(),
            'description' => fake()->sentence(),
            'status' => fake()->boolean(),
        ];
    }
}
