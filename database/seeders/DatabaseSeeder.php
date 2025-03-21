<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // $this->call(RolesTableSeeder::class);
        // $this->call(SectionsTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        // \App\Models\Admin::factory()->create([
        //     'name' => 'admin',
        //     'email' => 'admin@example.com', 
        //     'user_name' => 'admin',
        //     'password' => Hash::make('123456'),
        //     'role_id'=> 3,
        //     'role_name'=> 'Super',
        // ]);
    }
}
