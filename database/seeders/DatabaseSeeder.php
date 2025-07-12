<?php

namespace Database\Seeders;


use Database\Seeders\RoleSeeder;

use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(DataDiriSeeder::class);
        $this->call(PengalamanKerjaSeeder::class);
        $this->call(PendidikanSeeder::class);
        $this->call(BeritaSeeder::class);

        $this->call(PertanyaanSeeder::class);
        $this->call(AssessmentSeeder::class);
        $this->call(KurikulumSeeder::class);
        $this->call(TranskripNilaiSeeder::class);
        $this->call(KelasSeeder::class);
        $this->call(MataKuliahSeeder::class);
        $this->call(PertemuanSeeder::class);
        $this->call(AbsensiSeeder::class);
        $this->call(PelatihanSeeder::class);
    }
}
