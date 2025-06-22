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
                'nama_perguruan' => 'Politeknik Negeri Bali',
                'pembimbing1' => 'Dr. Andi Wijaya',
                'prodi' => 'Teknik Informatika',
                'judul_ta' => 'Sistem Informasi Akademik',
                'tahun_masuk' => '2000-01-01',
                'tahun_lulus' => '2004-01-01',
                'ipk' => 3.75,
                'nim' => '2001001',
                'jurusan' => 'Teknologi Informasi',
                'jenjang_pendidikan' => 'D3',
                'ijasah' => 'ijasah/mRr8TbckRx5fG6omaWhyrpjNht9jbBChRqHGn8Kk.pdf',
                'transkrip' => 'transkrip/d2J4XGxlwUrY9HyZCHlcXoZjwbnPVIWSbYaANgvX.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ],
          
        ]);
    }
}
