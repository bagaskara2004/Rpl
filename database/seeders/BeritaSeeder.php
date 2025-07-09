<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BeritaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('berita')->insert([
            [
                'admin_id' => 3,
                'judul' => "Melihat Keunggulan Teknologi Militer Israel dan Iran",
                'slug' => Str::slug("Melihat Keunggulan Teknologi Militer Israel dan Iran"),
                'deskripsi' => "Israel unggul dalam teknologi militer, sementara Iran andalkan strategi asimetris dengan rudal, drone, dan jaringan proksi bersenjata regional.Semalam Iran diserang Israel. Serangan itu menargetkan fasilitas nuklir dan militer Iran. Karena serangan itu, pemimpin Garda Revolusi Iran Hossein Salami tewas. Ia merupakan kepala komandan Korps Garda Revolusi Islam (IRGC) Iran. Sebelum kematiannya, ia memegang peran penting dalam IRGC, menjabat sebagai panglima tertinggi.Di tengah eskalasi tersebut, muncul pertanyaan: siapa sebenarnya yang lebih unggul secara teknologi militer?. Mengutip analisis dari berbagai sumber terbuka termasuk Jane’s Defence Weekly, The Jerusalem Post, serta laporan intelijen Barat yang dikutip oleh BBC, Reuters, dan Axios, menunjukkan bahwa Israel secara signifikan lebih unggul dalam aspek teknologi militer dibandingkan Iran.",
                'foto' => 'perang.jpeg',
                'created_at' => now(),
            ],
         
        ]);
    }
}
