<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IdmStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            'Sangat Tertinggal',
            'Tertinggal',
            'Berkembang',
            'Maju',
            'Mandiri'
        ];

        foreach ($statuses as $status) {
            \App\Models\IdmStatus::create(['name' => $status]);
        }
    }
}
