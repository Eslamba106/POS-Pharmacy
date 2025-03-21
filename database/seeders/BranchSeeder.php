<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Branch::updateOrCreate(['id' => 1], ['name' => 'main', 'domain' => 'a.localhost',  'created_at' => time()]);

    }
}
