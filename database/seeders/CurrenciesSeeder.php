<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Currency;

class CurrenciesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Currency::create([
            'name' => 'Peso',
            'symbol' => '$',
            'is_active' => true,
        ]);

        Currency::create([
            'name' => 'Dolar',
            'symbol' => '$',
            'is_active' => true,
        ]);

        Currency::create([
            'name' => 'Euro',
            'symbol' => '€',
            'is_active' => true,
        ]);
    }
}
