<?php

namespace Database\Seeders;

use App\Models\Kelas;
use Illuminate\Database\Seeder;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kelas = [
            ['kelas' => 'A'],
            ['kelas' => 'B'],
            ['kelas' => 'C'],
            ['kelas' => 'D'],
            ['kelas' => 'E'],
        ];

        foreach ($kelas as $kelasData) {
            Kelas::create($kelasData);
        }
    }
}
