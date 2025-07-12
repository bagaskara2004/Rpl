<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PelatihanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pelatihan')->insert([
            [
                'user_id' => 1,
                'nama_pelatihan' => 'Pelatihan Teknologi Informasi',
                'penyelenggara' => 'Penyelenggara A',
                'peran' => 'Peserta',
                'sertifikat' => 'sertifikat_a.pdf',
                'durasi' => '3 Hari',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'nama_pelatihan' => 'Pelatihan Web Development',
                'penyelenggara' => 'Penyelenggara B',
                'peran' => 'Pembicara',
                'sertifikat' => 'sertifikat_b.pdf',
                'durasi' => '5 Hari',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 3,
                'nama_pelatihan' => 'Pelatihan Database Management',
                'penyelenggara' => 'Penyelenggara C',
                'peran' => 'Moderator',
                'sertifikat' => 'sertifikat_c.pdf',
                'durasi' => '2 Hari',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
