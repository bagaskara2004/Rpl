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
            ['mata_kuliah_trpl' => 'Green Tourism', 'sks' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['mata_kuliah_trpl' => 'Bahasa Inggris Teknik', 'sks' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['mata_kuliah_trpl' => 'Pengantar Teknologi Informasi', 'sks' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['mata_kuliah_trpl' => 'Sistem Informasi', 'sks' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['mata_kuliah_trpl' => 'Struktur Data dan Algoritma', 'sks' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['mata_kuliah_trpl' => 'Matematika Diskrit', 'sks' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['mata_kuliah_trpl' => 'Pemrograman Terstuktur', 'sks' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['mata_kuliah_trpl' => 'Kesehatan dan Keselamatan Kerja', 'sks' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['mata_kuliah_trpl' => 'Aljabar Linear dan Matriks', 'sks' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['mata_kuliah_trpl' => 'Sistem Operasi dan Organisasi Komputer', 'sks' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['mata_kuliah_trpl' => 'Basis Data', 'sks' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['mata_kuliah_trpl' => 'Analisis kebutuhan Perangkat Lunak', 'sks' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['mata_kuliah_trpl' => 'Pemrograman Web', 'sks' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['mata_kuliah_trpl' => 'Pemrograman Berorientasi Obyek', 'sks' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['mata_kuliah_trpl' => 'Interaksi Manusia Dan Komputer', 'sks' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['mata_kuliah_trpl' => 'Statistika dan Probabilitas', 'sks' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['mata_kuliah_trpl' => 'Desain Pemodelan Perangkat Lunak', 'sks' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['mata_kuliah_trpl' => 'Jaringan Komputer', 'sks' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['mata_kuliah_trpl' => 'Sistem Informasi Pariwisata', 'sks' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['mata_kuliah_trpl' => 'Pemrograman Berbasis Desktop', 'sks' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['mata_kuliah_trpl' => 'Pemrograman Web berbasis Framework', 'sks' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['mata_kuliah_trpl' => 'Pendidikan Pancasila', 'sks' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['mata_kuliah_trpl' => 'Pengujian dan Verifikasi Perangkat Lunak', 'sks' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['mata_kuliah_trpl' => 'Data Warehouse', 'sks' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['mata_kuliah_trpl' => 'Pendidikan Agama', 'sks' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['mata_kuliah_trpl' => 'Pengolahan Citra Digital', 'sks' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['mata_kuliah_trpl' => 'Pemrograman Perangkat Bergerak', 'sks' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['mata_kuliah_trpl' => 'Cloud Computing', 'sks' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['mata_kuliah_trpl' => 'Pendidikan Kewarganegaraan', 'sks' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['mata_kuliah_trpl' => 'Database Cloud', 'sks' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['mata_kuliah_trpl' => 'Kecerdasan Artifisial', 'sks' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['mata_kuliah_trpl' => 'Integrasi Sistem Informasi', 'sks' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['mata_kuliah_trpl' => 'Audit Teknologi Informasi', 'sks' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['mata_kuliah_trpl' => 'Bahasa Indonesia', 'sks' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['mata_kuliah_trpl' => 'Metodologi Penelitian', 'sks' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['mata_kuliah_trpl' => 'Ide Kreatif dan Kewirausahaan', 'sks' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['mata_kuliah_trpl' => 'Dokumentasi Pengembangan Perangkat Lunak', 'sks' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['mata_kuliah_trpl' => 'Computer Vision', 'sks' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['mata_kuliah_trpl' => 'Data Mining', 'sks' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['mata_kuliah_trpl' => 'Keamanan Perangkat Lunak', 'sks' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['mata_kuliah_trpl' => 'Praktek Kerja Lapangan', 'sks' => 20, 'created_at' => now(), 'updated_at' => now()],
            ['mata_kuliah_trpl' => 'Kuliah Kerja Nyata', 'sks' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['mata_kuliah_trpl' => 'Skripsi/Project', 'sks' => 8, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
