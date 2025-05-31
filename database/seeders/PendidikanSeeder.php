<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PendidikanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pendidikan')->insert([
            [
                'user_id' => 1,
                'pembimbing1' => 'Dr. Andi Wijaya',
                'prodi' => 'Teknik Informatika',
                'judul_ta' => 'Sistem Informasi Akademik',
                'tahun_lulus' => 2022,
                'ipk' => 3.75,
                'nim' => '2001001',
                'jurusan' => 'Teknologi Informasi',
                'jenjang_pendidikan' => 'D3',
                'created_at' => now(),
                'updated_at' => now(),
            ],
          
        ]);
    }
}
