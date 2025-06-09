<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Debts;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Installments>
 */
class InstallmentsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'debt_id' => Debts::inRandomOrder()->first()->id,
            'due_date' => fake()->date(),
            'amount' => fake()->randomFloat(2, 1000, 10000),
            'status' => fake()->boolean(),
            'payment_date' => fake()->date(),
        ];
    }
}
