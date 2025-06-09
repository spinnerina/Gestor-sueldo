<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DebtStatus;

class DebtStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DebtStatus::create([
            'name' => 'Pendiente',
            'description' => 'El deuda esta pendiente de pago',
        ]);

        DebtStatus::create([
            'name' => 'Finalizado',
            'description' => 'El deuda ha sido pagada',
        ]);

        DebtStatus::create([
            'name' => 'Pausado',
            'description' => 'El deuda ha sido pausada',
        ]);

        DebtStatus::create([
            'name' => 'Cancelado',
            'description' => 'El deuda ha sido cancelada',
        ]);

        DebtStatus::create([
            'name' => 'En proceso',
            'description' => 'El deuda esta en proceso de pago',
        ]);
    }
}
