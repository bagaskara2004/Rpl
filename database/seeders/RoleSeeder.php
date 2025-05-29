<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            ['role' => 'user', 'created_at' => now(), 'updated_at' => now()],
            ['role' => 'assesor', 'created_at' => now(), 'updated_at' => now()],
            ['role' => 'admin', 'created_at' => now(), 'updated_at' => now()],
            ['role' => 'dosen', 'created_at' => now(), 'updated_at' => now()],
            ['role' => 'super admin', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
