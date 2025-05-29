<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('users')->insert([
            [
                'user_name' => 'Test User',
                'email' => 'test@example.com',
                'password' => bcrypt('password'),
                'role_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
        DB::table('users')->insert([
            [
                'user_name' => 'Assessor User',
                'email' => 'assessor@example.com',
                'password' => bcrypt('password'),
                'role_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
        DB::table('users')->insert([
            [
                'user_name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => bcrypt('password'),
                'role_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
        DB::table('users')->insert([
            [
                'user_name' => 'Dosen User',
                'email' => 'dosen@example.com',
                'password' => bcrypt('password'),
                'role_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
        DB::table('users')->insert([
            [
                'user_name' => 'Super Admin',
                'email' => 'superadmin@example.com',
                'password' => bcrypt('password'),
                'role_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
