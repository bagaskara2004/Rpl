<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\RoleSeeder;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);
        // User::factory(10)->create();
        
        \App\Models\User::factory()->create([
            'user_name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'role_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        \App\Models\User::factory()->create([
            'user_name' => 'Assessor User',
            'email' => 'assessor@example.com',
            'password' => bcrypt('password'),
            'role_id' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        \App\Models\User::factory()->create([
            'user_name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'role_id' => 3,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        \App\Models\User::factory()->create([
            'user_name' => 'Dosen User',
            'email' => 'dosen@example.com',
            'password' => bcrypt('password'),
            'role_id' => 4,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        \App\Models\User::factory()->create([
            'user_name' => 'Super Admin',
            'email' => 'superadmin@example.com',
            'password' => bcrypt('password'),
            'role_id' => 5,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
