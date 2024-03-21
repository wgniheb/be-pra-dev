<?php

namespace Database\Seeders;

use App\Models\RiskIssue;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RiskIssueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $issues = [
            'Severe',
            'Major',
            'Significant',
            'Minor',
            'Insignificant',
        ];

        foreach ($issues as $issue) {
            RiskIssue::create(['name' => $issue]);
        }
    }
}
