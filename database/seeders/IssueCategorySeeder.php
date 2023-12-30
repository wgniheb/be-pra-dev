<?php

namespace Database\Seeders;

use App\Models\IssueCategory;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class IssueCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        IssueCategory::create([
            'name' => 'Livelihood',
            'description' => 'Livelihood is the means of making a living. It encompasses people capabilities, assets, income and activities required to secure the necessities of life.',
        ]);
        IssueCategory::create([
            'name' => 'Infrastructure',
            'description' => 'Infrastructure is the basic physical and organizational structures and facilities needed for the operation of a society or enterprise, or the services and facilities necessary for an economy to function.',
        ]);
        IssueCategory::create([
            'name' => 'Environment',
            'description' => 'Environment is the surroundings or conditions in which a person, animal, or plant lives or operates.',
        ]);
        IssueCategory::create([
            'name' => 'Labour',
            'description' => 'Labour is the physical and mental effort of humans used in the production of goods and services.',
        ]);
    }
}
