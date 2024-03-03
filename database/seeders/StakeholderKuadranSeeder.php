<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StakeholderKuadran;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StakeholderKuadranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StakeholderKuadran::create([
            'name' => 'A',
            'description' => 'High Power, High Interest'
        ]);
        StakeholderKuadran::create([
            'name' => 'B',
            'description' => 'Low Power, High Interest'
        ]);
        StakeholderKuadran::create([
            'name' => 'C',
            'description' => 'High Power, Low Interest'
        ]);
        StakeholderKuadran::create([
            'name' => 'D',
            'description' => 'Low Power, Low Interest'
        ]);
    }
}
