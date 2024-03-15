<?php

namespace Database\Seeders;

use App\Models\IssueStatus;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class IssueStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        IssueStatus::create([
            'id' => 1,
            'name' => 'Open',
        ]);
        IssueStatus::create([
            'id' => 2,
            'name' => 'Closed',
        ]);
    }
}
