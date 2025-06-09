<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Jobs;
use App\Models\Currency;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Salaries>
 */
class SalariesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'job_id' => Jobs::inRandomOrder()->first()->id,
            'payment_date' => fake()->date(),
            'gross_amount' => fake()->randomFloat(2, 1000, 10000),
            'net_amount' => fake()->randomFloat(2, 1000, 10000),
            'currency_id' => Currency::inRandomOrder()->first()->id,
            'description' => fake()->sentence(),
            'payslip_url' => fake()->url(),
            'status' => fake()->boolean(),
        ];
    }
}
