<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PengalamanKerjaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pengalaman_kerja')->insert([
            [
                'user_id' => 1,
                'nama_perusahaan' => 'PT Maju Jaya',
                'alamat_perusahaan' => 'Jl. Industri No. 10, Denpasar',
                'kota_kab_perusahaan' => 'Denpasar',
                'provinsi_perusahaan' => 'Bali',
                'negara_perusahaan' => 'Indonesia',
                'sejak' => '2022-01-01',
                'sampai' => '2023-12-31',
                'dokumen_pendukung' => null,
                'nama_staf' => 'Budi Santoso',
                'posisi_staf' => 'Manager HRD',
                'tlp_staf' => '081234567890',
                'email_staf' => 'budi@majujaya.com',
                'fax_staf' => '0361-123456',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'nama_perusahaan' => 'CV Sukses Bersama',
                'alamat_perusahaan' => 'Jl. Merdeka No. 5, Denpasar',
                'kota_kab_perusahaan' => 'Denpasar',
                'provinsi_perusahaan' => 'Bali',
                'negara_perusahaan' => 'Indonesia',
                'sejak' => '2020-06-01',
                'sampai' => '2021-12-31',
                'dokumen_pendukung' => null,
                'nama_staf' => 'Siti Aminah',
                'posisi_staf' => 'Supervisor',
                'tlp_staf' => '081298765432',
                'email_staf' => 'siti@suksesbersama.com',
                'fax_staf' => '0361-654321',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'nama_perusahaan' => 'PT Maju Jaya',
                'alamat_perusahaan' => 'Jl. Industri No. 10, Denpasar',
                'kota_kab_perusahaan' => 'Denpasar',
                'provinsi_perusahaan' => 'Bali',
                'negara_perusahaan' => 'Indonesia',
                'sejak' => '2022-01-01',
                'sampai' => '2023-12-31',
                'dokumen_pendukung' => null,
                'nama_staf' => 'Budi Santoso',
                'posisi_staf' => 'Manager HRD',
                'tlp_staf' => '081234567890',
                'email_staf' => 'budi@majujaya.com',
                'fax_staf' => '0361-123456',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 3,
                'nama_perusahaan' => 'PT Maju Jaya',
                'alamat_perusahaan' => 'Jl. Industri No. 10, Denpasar',
                'kota_kab_perusahaan' => 'Denpasar',
                'provinsi_perusahaan' => 'Bali',
                'negara_perusahaan' => 'Indonesia',
                'sejak' => '2022-01-01',
                'sampai' => '2023-12-31',
                'dokumen_pendukung' => null,
                'nama_staf' => 'Budi Santoso',
                'posisi_staf' => 'Manager HRD',
                'tlp_staf' => '081234567890',
                'email_staf' => 'budi@majujaya.com',
                'fax_staf' => '0361-123456',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
