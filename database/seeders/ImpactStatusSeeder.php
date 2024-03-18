<?php

namespace Database\Seeders;

use App\Models\ImpactStatus;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ImpactStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ImpactStatus::create([
            'id' => 1,
            'name' => 'Positive',
        ]);
        ImpactStatus::create([
            'id' => 2,
            'name' => 'Negative',
        ]);
    }
}
