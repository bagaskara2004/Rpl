<?php

namespace Database\Seeders;

use App\Models\MataKuliah;
use App\Models\Kelas;
use App\Models\User;
use Illuminate\Database\Seeder;

class MataKuliahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil data dosen (user dengan role_id yang sesuai untuk dosen)
        $dosens = User::whereHas('role', function ($query) {
            $query->where('role', 'LIKE', '%dosen%');
        })->get();

        // Jika tidak ada dosen, gunakan user admin sebagai fallback
        if ($dosens->isEmpty()) {
            $dosens = User::limit(3)->get();
        }

        
        // Ambil semua kelas
        $kelasList = Kelas::all();

        $mataKuliahData = [
            [
                'mata_kuliah' => 'Pemrograman Web',
                'semester' => 5,
                'tahun' => 2024
            ],
            [
                'mata_kuliah' => 'Basis Data',
                'semester' => 4,
                'tahun' => 2024
            ],
            [
                'mata_kuliah' => 'Rekayasa Perangkat Lunak',
                'semester' => 6,
                'tahun' => 2024
            ],
            [
                'mata_kuliah' => 'Jaringan Komputer',
                'semester' => 5,
                'tahun' => 2024
            ],
            [
                'mata_kuliah' => 'Algoritma dan Struktur Data',
                'semester' => 3,
                'tahun' => 2024
            ],
        ];

      
    }
}
