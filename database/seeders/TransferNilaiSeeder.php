<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransferNilaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Contoh data transfer nilai
        // Pastikan asesor_id, kurikulum_id, dan transkrip_id sudah ada di database

        $transferData = [
            // Transfer beberapa mata kuliah
            [
                'asesor_id' => 2, // Sesuaikan dengan ID asesor yang ada
                'kurikulum_id' => 1, // Pemrograman Web
                'transkrip_id' => 1, // Sesuaikan dengan ID transkrip yang ada
                'nilai' => 'A',
                'catatan' => 'Transfer dari mata kuliah Pemrograman Website',
                'status' => 1, // 1 = approved
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'asesor_id' => 2,
                'kurikulum_id' => 2, // Basis Data
                'transkrip_id' => 2,
                'nilai' => 'B+',
                'catatan' => 'Transfer dari mata kuliah Database Management',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'asesor_id' => 2,
                'kurikulum_id' => 3, // Jaringan Komputer
                'transkrip_id' => 3,
                'nilai' => 'A-',
                'catatan' => 'Transfer dari mata kuliah Computer Networks',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'asesor_id' => 2,
                'kurikulum_id' => 4, // Analisis dan Perancangan Sistem
                'transkrip_id' => 4,
                'nilai' => 'A',
                'catatan' => 'Transfer dari mata kuliah System Analysis',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'asesor_id' => 2,
                'kurikulum_id' => 5, // Kecerdasan Buatan
                'transkrip_id' => 5,
                'nilai' => 'B',
                'catatan' => 'Transfer dari mata kuliah Artificial Intelligence',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($transferData as $data) {
            // Cek apakah asesor_id, kurikulum_id, dan transkrip_id ada
            $asesorExists = DB::table('users')->where('id', $data['asesor_id'])->exists();
            $kurikulumExists = DB::table('kurikulum')->where('id', $data['kurikulum_id'])->exists();
            $transkripExists = DB::table('transkrip_nilai')->where('id', $data['transkrip_id'])->exists();

            if ($asesorExists && $kurikulumExists && $transkripExists) {
                DB::table('transfer_nilai')->insert($data);
            }
        }
    }
}
