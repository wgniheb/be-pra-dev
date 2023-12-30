<?php

namespace Database\Seeders;

use App\Models\IssueMatrix;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class IssueMatrixSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        IssueMatrix::create([
            'name' => 'Likelihood and Frequency',
            'description' => 'Likelihood and Frequency is a matrix to determine the likelihood and frequency of an issue.',
        ]);
        IssueMatrix::create([
            'name' => 'Severity of Source Information',
            'description' => 'Severity of Source Information is a matrix to determine the severity of source information of an issue.',
        ]);
        IssueMatrix::create([
            'name' => 'Severity of Scope Social Impact',
            'description' => 'Severity of Scope Social Impact is a matrix to determine the severity of scope social impact of an issue.',
        ]);
        IssueMatrix::create([
            'name' => 'Severity of Impact Healthiness',
            'description' => 'Severity of Impact Healthiness is a matrix to determine the severity of impact healthiness of an issue.',
        ]);
        IssueMatrix::create([
            'name' => 'Severity of Impacted to Material',
            'description' => 'Severity of Impacted to Material is a matrix to determine the severity of impacted to material of an issue.',
        ]);
    }
}
