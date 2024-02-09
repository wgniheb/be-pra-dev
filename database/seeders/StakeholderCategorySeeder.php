<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StakeholderCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StakeholderCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StakeholderCategory::create(['name' => 'Individual']);
        StakeholderCategory::create(['name' => 'Organization']);
        StakeholderCategory::create(['name' => 'Government']);
    }
}
