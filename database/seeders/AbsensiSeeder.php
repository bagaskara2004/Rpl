<?php

namespace Database\Seeders;

use App\Models\Absensi;
use App\Models\Pertemuan;
use App\Models\User;
use Illuminate\Database\Seeder;

class AbsensiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pertemuanList = Pertemuan::all();
        $users = User::limit(10)->get(); // Ambil 10 user pertama

        $statusOptions = ['Hadir', 'Izin', 'Sakit', 'Alpha'];

        foreach ($pertemuanList as $pertemuan) {
            // Buat absensi untuk beberapa user di setiap pertemuan
            $selectedUsers = $users->random(rand(3, 7)); // Pilih 3-7 user secara acak

            foreach ($selectedUsers as $user) {
                // Pastikan tidak ada duplikat absensi untuk user dan pertemuan yang sama
                $existingAbsensi = Absensi::where('user_id', $user->id)
                    ->where('pertemuan_id', $pertemuan->id)
                    ->first();

                if (!$existingAbsensi) {
                    Absensi::create([
                        'user_id' => $user->id,
                        'pertemuan_id' => $pertemuan->id,
                        'status' => $statusOptions[array_rand($statusOptions)]
                    ]);
                }
            }
        }
    }
}
