<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        \App\Models\Role::updateOrCreate(['id' => 1], ['name' => 'casher', 'caption' => 'Casher role', 'is_admin' => 0, 'created_at' => time()]);
        \App\Models\Role::updateOrCreate(['id' => 2], ['name' => 'admin', 'caption' => 'Admin role', 'is_admin' => 1, 'created_at' => time()]);
        \App\Models\Role::updateOrCreate(['id' => 5], ['name' => 'super_admin', 'caption' => 'Super Admin role', 'is_admin' => 1, 'created_at' => time()]);
    }
}
