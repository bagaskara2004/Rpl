<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DataDiriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('data_diri')->insert([
            [
                'user_id' => 1,
                'nama_lengkap' => 'Bagas Pratama',
                'tgl_lahir' => '2000-01-01',
                'tempat_lahir' => 'Tabanan',
                'jenis_kelamin' => 'laki-laki',
                'email' => 'test@example.com',
                'hp' => '081234567890',
                'tlp' => '0211234567',
                'alamat' => 'Jl. Mawar No. 1',
                'kab_kota' => 'Denpasar',
                'provinsi' => 'Bali',
                'kode_pos' => '80111',
                'foto' => null,
                'cv' => null,
                'sumber_biaya_pendidikan' => 'Mandiri',
                'nama_ibu' => 'Siti Aminah',
                'pekerjaan_ibu' => 'Ibu Rumah Tangga',
                'nama_ayah' => 'Budi Pratama',
                'pekerjaan_ayah' => 'Wiraswasta',
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}
