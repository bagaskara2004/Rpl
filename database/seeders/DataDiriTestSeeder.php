<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DataDiri;
use App\Models\Pendidikan;
use App\Models\PengalamanKerja;
use App\Models\User;

class DataDiriTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat user untuk testing jika belum ada
        $user = User::firstOrCreate([
            'email' => 'student@test.com'
        ], [
            'user_name' => 'student_test',
            'password' => bcrypt('password'),
            'role_id' => 1
        ]);

        // Buat data diri
        $dataDiri = DataDiri::firstOrCreate([
            'user_id' => $user->id
        ], [
            'nama_lengkap' => 'John Doe Student',
            'email' => 'student@test.com',
            'tgl_lahir' => '1995-01-15',
            'jenis_kelamin' => 'Laki-laki',
            'hp' => '081234567890',
            'tlp' => '0211234567',
            'alamat' => 'Jl. Test No. 123',
            'kab_kota' => 'Jakarta Selatan',
            'provinsi' => 'DKI Jakarta',
            'kode_pos' => '12345',
            'sumber_biaya_pen' => 'Orang Tua',
            'nama_ayah' => 'Bapak Doe',
            'pekerjaan_ayah' => 'Pegawai Swasta',
            'nama_ibu' => 'Ibu Doe',
            'pekerjaan_ibu' => 'Ibu Rumah Tangga',
            'foto' => null,
            'status' => 1
        ]);

        // Buat data pendidikan
        Pendidikan::firstOrCreate([
            'user_id' => $user->id
        ], [
            'prodi' => 'Teknik Informatika',
            'jurusan' => 'Teknik Informatika',
            'nim' => '20210001',
            'jenjang_pendidikan' => 'S1',
            'tahun_lulus' => '2024',
            'ipk' => '3.75',
            'pembimbing1' => 'Dr. Jane Smith',
            'judul_ta' => 'Sistem Informasi Berbasis Web'
        ]);

        // Buat data pengalaman kerja
        PengalamanKerja::firstOrCreate([
            'user_id' => $user->id,
            'nama_perusahaan' => 'PT Tech Solutions'
        ], [
            'alamat_perusahaan' => 'Jl. Sudirman No. 45',
            'kota_kab_perusahaan' => 'Jakarta Pusat',
            'provinsi_perusahaan' => 'DKI Jakarta',
            'negara_perusahaan' => 'Indonesia',
            'sejak' => '2023-01-01',
            'sampai' => '2024-12-31',
            'nama_staf' => 'Mr. Manager',
            'posisi_staf' => 'HR Manager',
            'tlp_staf' => '021987654321',
            'email_staf' => 'hr@techsolutions.com',
            'fax_staf' => '021987654322',
            'dokumen_pendukung' => null
        ]);

        // Buat data pertanyaan jika belum ada
        $pertanyaan1 = \App\Models\Pertanyaan::firstOrCreate([
            'pertanyaan' => 'Apakah Anda memiliki pengalaman programming?'
        ]);

        $pertanyaan2 = \App\Models\Pertanyaan::firstOrCreate([
            'pertanyaan' => 'Apakah Anda pernah menggunakan framework web?'
        ]);

        $pertanyaan3 = \App\Models\Pertanyaan::firstOrCreate([
            'pertanyaan' => 'Apakah Anda memiliki pengalaman database?'
        ]);

        // Buat data assessment (jawaban)
        \App\Models\Assessment::firstOrCreate([
            'user_id' => $user->id,
            'pertanyaan_id' => $pertanyaan1->id
        ], [
            'jawaban' => 0 // Ya
        ]);

        \App\Models\Assessment::firstOrCreate([
            'user_id' => $user->id,
            'pertanyaan_id' => $pertanyaan2->id
        ], [
            'jawaban' => 0 // Ya
        ]);

        \App\Models\Assessment::firstOrCreate([
            'user_id' => $user->id,
            'pertanyaan_id' => $pertanyaan3->id
        ], [
            'jawaban' => 1 // Tidak
        ]);

        $this->command->info('Data Diri test seeder completed!');
    }
}
