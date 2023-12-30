<?php

namespace Database\Seeders;

use App\Models\Entity;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EntitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Entity::create([
            'name' => 'PT Olahkarsa Inovasi Indonesia',
            'address' => 'Kota Bandung',
        ]);
        Entity::create([
            'name' => 'PT Inti Solusi Teknologi',
            'address' => 'Kota Malang',
        ]);
        Entity::create([
            'name' => 'PT Jaya Teknologi Indonesia',
            'address' => 'Kota Surabaya',
        ]);
    }
}
