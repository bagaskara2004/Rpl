<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KurikulumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kurikulum')->insert([
            [
                'mata_kuliah_trpl' => 'Pemrograman Web',
                'sks' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'mata_kuliah_trpl' => 'Basis Data',
                'sks' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'mata_kuliah_trpl' => 'Jaringan Komputer',
                'sks' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'mata_kuliah_trpl' => 'Analisis dan Perancangan Sistem',
                'sks' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'mata_kuliah_trpl' => 'Kecerdasan Buatan',
                'sks' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
