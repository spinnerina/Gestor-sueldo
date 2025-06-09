<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\DebtStatus;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Debts>
 */
class DebtsFactory extends Factory
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
            'name' => fake()->name(),
            'description' => fake()->sentence(),
            'total_amount' => fake()->randomFloat(2, 1000, 10000),
            'interest_rate' => fake()->numberBetween(1, 100),
            'number_of_installments' => fake()->numberBetween(1, 48),
            'debts_status_id' => DebtStatus::inRandomOrder()->first()->id,
        ];
    }
}
