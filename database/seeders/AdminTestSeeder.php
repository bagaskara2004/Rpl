<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\TranskripNilai;
use App\Models\Assessment;
use App\Models\Pertanyaan;
use App\Models\Role;

class AdminTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create sample roles first (sesuai dengan LoginController)
        $roles = [
            1 => 'user',     // role_id = 1 untuk user biasa
            2 => 'assessor', // role_id = 2 untuk assessor
            3 => 'admin',    // role_id = 3 untuk admin
            4 => 'dosen',    // role_id = 4 untuk dosen
            5 => 'superadmin' // role_id = 5 untuk superadmin
        ];

        foreach ($roles as $id => $role) {
            Role::create([
                'id' => $id,
                'role' => $role,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Create sample pertanyaan first
        $pertanyaanList = [
            'Apa pengalaman kerja Anda dalam bidang ini?',
            'Bagaimana kemampuan teknis Anda?',
            'Seberapa familiar Anda dengan teknologi terbaru?'
        ];

        foreach ($pertanyaanList as $pertanyaan) {
            Pertanyaan::create([
                'pertanyaan' => $pertanyaan,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Create test users
        $userRoleId = 1; // user role
        $assessorRoleId = 2; // assessor role
        $adminRoleId = 3; // admin role

        // Create admin user
        User::create([
            'role_id' => $adminRoleId,
            'user_name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin123'),
            'block' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Create assessor user
        User::create([
            'role_id' => $assessorRoleId,
            'user_name' => 'assessor',
            'email' => 'assessor@assessor.com',
            'password' => bcrypt('assessor123'),
            'block' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Create regular users
        for ($i = 1; $i <= 10; $i++) {
            User::create([
                'role_id' => $userRoleId,
                'user_name' => 'testuser' . $i,
                'email' => 'user' . $i . '@test.com',
                'password' => bcrypt('password'),
                'block' => false,
                'created_at' => now()->subDays(rand(0, 30)),
                'updated_at' => now(),
            ]);
        }

        // Create test transkrip nilai
        $users = User::all();
        $matkulList = ['Matematika', 'Fisika', 'Kimia', 'Biologi', 'Bahasa Indonesia', 'Bahasa Inggris', 'Sejarah', 'Geografi'];
        $gradeList = ['A', 'B', 'C', 'D'];

        foreach ($users->take(5) as $user) {
            for ($j = 0; $j < rand(2, 5); $j++) {
                TranskripNilai::create([
                    'user_id' => $user->id,
                    'mata_kuliah' => $matkulList[array_rand($matkulList)],
                    'nilai_huruf' => $gradeList[array_rand($gradeList)],
                    'nilai_angka' => rand(60, 100),
                    'sks' => rand(2, 4),
                    'created_at' => now()->subDays(rand(0, 60)),
                    'updated_at' => now(),
                ]);
            }
        }

        // Create test assessments (using actual table structure)
        $pertanyaanIds = Pertanyaan::pluck('id');
        foreach ($users->take(3) as $user) {
            foreach ($pertanyaanIds as $pertanyaanId) {
                Assessment::create([
                    'user_id' => $user->id,
                    'pertanyaan_id' => $pertanyaanId,
                    'jawaban' => rand(1, 5),
                    'status' => rand(0, 2),
                    'created_at' => now()->subDays(rand(0, 30)),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
