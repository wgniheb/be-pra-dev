<?php

namespace Database\Seeders;

use App\Models\PublishedStatus;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PublishedStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            ['name' => 'External'],
            ['name' => 'Internal'],
        ];

        foreach ($statuses as $status) {
            PublishedStatus::create($status);
        }
    }
}
