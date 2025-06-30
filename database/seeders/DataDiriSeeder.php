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
                'foto' => 'foto/Ie15rEmDnGKBRs8HQ3vyEhObjSQ3tskcG4iAZBqx.jpg',
                'cv' => 'cv/ESrPhpmsaUcs773WJvMzQdGFy6C1lwSRdF3ImUrG.pdf',
                'sumber_biaya_pendidikan' => 'Mandiri',
                'nama_ibu' => 'Siti Aminah',
                'pekerjaan_ibu' => 'Ibu Rumah Tangga',
                'nama_ayah' => 'Budi Pratama',
                'pekerjaan_ayah' => 'Wiraswasta',
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'nama_lengkap' => 'Christine Brooks',
                'tgl_lahir' => '1999-05-15',
                'tempat_lahir' => 'Jakarta',
                'jenis_kelamin' => 'perempuan',
                'email' => 'christine@example.com',
                'hp' => '081987654321',
                'tlp' => '0217654321',
                'alamat' => 'Jl. Melati No. 25',
                'kab_kota' => 'Jakarta Selatan',
                'provinsi' => 'DKI Jakarta',
                'kode_pos' => '12345',
                'foto' => null,
                'cv' => null,
                'sumber_biaya_pendidikan' => 'Beasiswa',
                'nama_ibu' => 'Maria Brooks',
                'pekerjaan_ibu' => 'Guru',
                'nama_ayah' => 'John Brooks',
                'pekerjaan_ayah' => 'Engineer',
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 3,
                'nama_lengkap' => 'Ahmad Rahman',
                'tgl_lahir' => '2001-03-20',
                'tempat_lahir' => 'Surabaya',
                'jenis_kelamin' => 'laki-laki',
                'email' => 'ahmad@example.com',
                'hp' => '081555666777',
                'tlp' => '031987654',
                'alamat' => 'Jl. Kenanga No. 10',
                'kab_kota' => 'Surabaya',
                'provinsi' => 'Jawa Timur',
                'kode_pos' => '60111',
                'foto' => null,
                'cv' => null,
                'sumber_biaya_pendidikan' => 'Mandiri',
                'nama_ibu' => 'Fatimah Rahman',
                'pekerjaan_ibu' => 'Pedagang',
                'nama_ayah' => 'Abdul Rahman',
                'pekerjaan_ayah' => 'PNS',
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
