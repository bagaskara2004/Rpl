<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TranskripNilaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('transkrip_nilai')->insert([
            [
                'user_id' => 1,
                'mata_kuliah' => 'Pemrograman Web',
                'sks' => 3,
                'nilai_huruf' => 'A',
                'nilai_angka' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'mata_kuliah' => 'Basis Data',
                'sks' => 3,
                'nilai_huruf' => 'B+',
                'nilai_angka' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'mata_kuliah' => 'Jaringan Komputer',
                'sks' => 2,
                'nilai_huruf' => 'A-',
                'nilai_angka' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'mata_kuliah' => 'Matematika Diskrit',
                'sks' => 2,
                'nilai_huruf' => 'B',
                'nilai_angka' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'mata_kuliah' => 'Sistem Operasi',
                'sks' => 3,
                'nilai_huruf' => 'A',
                'nilai_angka' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
