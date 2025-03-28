<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Branch;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // $this->call(AddIdToAllTables::class);
        // $this->call(RolesTableSeeder::class);
        // $this->call(BranchSeeder::class);
        $this->call(SectionsTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        // \App\Models\Staff::factory()->create([
        //     'name' => 'new',
        //     'email' => 'new@example.com', 
        //     'user_name' => 'new',
        //     'password' => Hash::make('12345'),
        //     'role_id'=> 1,
        //     'role_name'=> 'admin',
        // ]);
        // \App\Models\Admin::factory()->create([
        //     'name' => 'super_admin',
        //     'email' => 'super_admin@example.com', 
        //     'user_name' => 'super_admin',
        //     'password' => Hash::make('12345'),
        //     'role_id'=> 5,
        //     'role_name'=> 'super_admin',
        // ]);
    }
}
