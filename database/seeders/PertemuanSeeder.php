<?php

namespace Database\Seeders;

use App\Models\Pertemuan;
use App\Models\MataKuliah;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PertemuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mataKuliahList = MataKuliah::with(['kelas'])->get();

        foreach ($mataKuliahList as $mataKuliah) {
            // Buat 8 pertemuan untuk setiap mata kuliah (satu semester)
            for ($i = 1; $i <= 8; $i++) {
                Pertemuan::create([
                    'kelas_id' => $mataKuliah->kelas_id,
                    'mata_kuliah_id' => $mataKuliah->id,
                    'nama_pertemuan' => "Pertemuan {$i} - {$mataKuliah->mata_kuliah}",
                    'tanggal' => Carbon::now()->addWeeks($i - 1)->format('Y-m-d')
                ]);
            }
        }
    }
}
