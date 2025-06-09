<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Companies;
use App\Models\Jobs;
use App\Models\Salaries;
use App\Models\ExpenseCategories;
use App\Models\Expenses;
use App\Models\Debts;
use App\Models\Installments;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            CurrenciesSeeder::class,
            DebtStatusSeeder::class,
            RoleSeeder::class,
        ]);

        User::factory(10)->create();
        Companies::factory(10)->create();
        Jobs::factory(10)->create();
        Salaries::factory(10)->create();
        ExpenseCategories::factory(5)->create();
        Expenses::factory(20)->create();
        Debts::factory(20)->create();
        Installments::factory(40)->create();
    }
}
