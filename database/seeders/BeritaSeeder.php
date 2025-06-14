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
            [
                'admin_id' => 3,
                'judul' => "Membedah Teknologi Pesawat Air India Boeing 787-8 Dreamliner yang Jatuh",
                'slug' => Str::slug("Membedah Teknologi Pesawat Air India Boeing 787-8 Dreamliner yang Jatuh"),
                'deskripsi' => "Pesawat Boeing 787-8 Dreamliner milik Air India diklaim memiliki mesin yang lebih cepat dibandingkan jet berbadan lebar lainnya dalam sejarah penerbangan.Pada hari ini, Kamis (12/6/2025), pesawat Air India yang dalam perjalanan dari Ahmedabad menuju London mengalami kecelakaan, menjadi insiden fatal pertama untuk model Boeing 787-8 Dreamliner sejak peluncurannya secara komersial pada tahun 2011. Pesawat Air India AI171 yang membawa 242 penumpang itu lepas landas dari Bandara Sardar Vallabhai Patel di Ahmedabad sekitar pukul 14.00 waktu setempat, namun beberapa menit setelahnya pesawat jatuh di area permukiman.",
                'foto' => 'pesawat.jpg',
                'created_at' => now(),
            ],
            [
                'admin_id' => 3,
                'judul' => "Teknologi Pemurnian Air Berstandar Industri Antariksa Masuk Pasar Indonesia",
                'slug' => Str::slug("Teknologi Pemurnian Air Berstandar Industri Antariksa Masuk Pasar Indonesia"),
                'deskripsi' => "Pemurnian air di Indonesia memasuki babak baru dengan peluncuran resmi Angel asal Tiongkok di bidang pemurnian air. Dengan pengalaman lebih dari tiga dekade dan sembilan sertifikasi internasional, Angel kini menghadirkan teknologi pemurnian air berstandar industri antariksa untuk kebutuhan rumah tangga, komersial, hingga fasilitas publik di seluruh Indonesia. Angel telah lama dikenal sebagai pelopor dalam teknologi pemurnian air. Melalui investasi besar dalam riset dan pengembangan, Angel menghadirkan berbagai teknologi inovatif seperti Membran Reverse Osmosis tahan lama hasil pengembangan sendiri, Teknologi Sterilisasi APCM, Teknologi Pemanas Instan Aliran Tinggi, serta Pompa Diafragma Ultra-Senyap. Air bersih adalah hak dasar setiap manusia. Melalui kehadiran Angel di Indonesia, kami menghadirkan teknologi pemurnian air berstandar antariksa untuk menjawab tantangan kualitas air saat ini dan di masa depan, kata Chairman & President Angel Group Kong Na dikutip Kamis (12/6/2025).",
                'foto' => 'air.jpg',
                'created_at' => now(),
            ],
            [
                'admin_id' => 3,
                'judul' => "Melihat Keunggulan Teknologi Militer Israel dan Iran",
                'slug' => Str::slug("Melihat Keunggulan Teknologi Militer Israel dan Iran"),
                'deskripsi' => "Israel unggul dalam teknologi militer, sementara Iran andalkan strategi asimetris dengan rudal, drone, dan jaringan proksi bersenjata regional.Semalam Iran diserang Israel. Serangan itu menargetkan fasilitas nuklir dan militer Iran. Karena serangan itu, pemimpin Garda Revolusi Iran Hossein Salami tewas. Ia merupakan kepala komandan Korps Garda Revolusi Islam (IRGC) Iran. Sebelum kematiannya, ia memegang peran penting dalam IRGC, menjabat sebagai panglima tertinggi.Di tengah eskalasi tersebut, muncul pertanyaan: siapa sebenarnya yang lebih unggul secara teknologi militer?. Mengutip analisis dari berbagai sumber terbuka termasuk Jane’s Defence Weekly, The Jerusalem Post, serta laporan intelijen Barat yang dikutip oleh BBC, Reuters, dan Axios, menunjukkan bahwa Israel secara signifikan lebih unggul dalam aspek teknologi militer dibandingkan Iran.",
                'foto' => 'perang.jpeg',
                'created_at' => now(),
            ],
            [
                'admin_id' => 3,
                'judul' => "Membedah Teknologi Pesawat Air India Boeing 787-8 Dreamliner yang Jatuh",
                'slug' => Str::slug("Membedah Teknologi Pesawat Air India Boeing 787-8 Dreamliner yang Jatuh"),
                'deskripsi' => "Pesawat Boeing 787-8 Dreamliner milik Air India diklaim memiliki mesin yang lebih cepat dibandingkan jet berbadan lebar lainnya dalam sejarah penerbangan.Pada hari ini, Kamis (12/6/2025), pesawat Air India yang dalam perjalanan dari Ahmedabad menuju London mengalami kecelakaan, menjadi insiden fatal pertama untuk model Boeing 787-8 Dreamliner sejak peluncurannya secara komersial pada tahun 2011. Pesawat Air India AI171 yang membawa 242 penumpang itu lepas landas dari Bandara Sardar Vallabhai Patel di Ahmedabad sekitar pukul 14.00 waktu setempat, namun beberapa menit setelahnya pesawat jatuh di area permukiman.",
                'foto' => 'pesawat.jpg',
                'created_at' => now(),
            ],
            [
                'admin_id' => 3,
                'judul' => "Teknologi Pemurnian Air Berstandar Industri Antariksa Masuk Pasar Indonesia",
                'slug' => Str::slug("Teknologi Pemurnian Air Berstandar Industri Antariksa Masuk Pasar Indonesia"),
                'deskripsi' => "Pemurnian air di Indonesia memasuki babak baru dengan peluncuran resmi Angel asal Tiongkok di bidang pemurnian air. Dengan pengalaman lebih dari tiga dekade dan sembilan sertifikasi internasional, Angel kini menghadirkan teknologi pemurnian air berstandar industri antariksa untuk kebutuhan rumah tangga, komersial, hingga fasilitas publik di seluruh Indonesia. Angel telah lama dikenal sebagai pelopor dalam teknologi pemurnian air. Melalui investasi besar dalam riset dan pengembangan, Angel menghadirkan berbagai teknologi inovatif seperti Membran Reverse Osmosis tahan lama hasil pengembangan sendiri, Teknologi Sterilisasi APCM, Teknologi Pemanas Instan Aliran Tinggi, serta Pompa Diafragma Ultra-Senyap. Air bersih adalah hak dasar setiap manusia. Melalui kehadiran Angel di Indonesia, kami menghadirkan teknologi pemurnian air berstandar antariksa untuk menjawab tantangan kualitas air saat ini dan di masa depan, kata Chairman & President Angel Group Kong Na dikutip Kamis (12/6/2025).",
                'foto' => 'air.jpg',
                'created_at' => now(),
            ],
            [
                'admin_id' => 3,
                'judul' => "Melihat Keunggulan Teknologi Militer Israel dan Iran",
                'slug' => Str::slug("Melihat Keunggulan Teknologi Militer Israel dan Iran"),
                'deskripsi' => "Israel unggul dalam teknologi militer, sementara Iran andalkan strategi asimetris dengan rudal, drone, dan jaringan proksi bersenjata regional.Semalam Iran diserang Israel. Serangan itu menargetkan fasilitas nuklir dan militer Iran. Karena serangan itu, pemimpin Garda Revolusi Iran Hossein Salami tewas. Ia merupakan kepala komandan Korps Garda Revolusi Islam (IRGC) Iran. Sebelum kematiannya, ia memegang peran penting dalam IRGC, menjabat sebagai panglima tertinggi.Di tengah eskalasi tersebut, muncul pertanyaan: siapa sebenarnya yang lebih unggul secara teknologi militer?. Mengutip analisis dari berbagai sumber terbuka termasuk Jane’s Defence Weekly, The Jerusalem Post, serta laporan intelijen Barat yang dikutip oleh BBC, Reuters, dan Axios, menunjukkan bahwa Israel secara signifikan lebih unggul dalam aspek teknologi militer dibandingkan Iran.",
                'foto' => 'perang.jpeg',
                'created_at' => now(),
            ],
            [
                'admin_id' => 3,
                'judul' => "Membedah Teknologi Pesawat Air India Boeing 787-8 Dreamliner yang Jatuh",
                'slug' => Str::slug("Membedah Teknologi Pesawat Air India Boeing 787-8 Dreamliner yang Jatuh"),
                'deskripsi' => "Pesawat Boeing 787-8 Dreamliner milik Air India diklaim memiliki mesin yang lebih cepat dibandingkan jet berbadan lebar lainnya dalam sejarah penerbangan.Pada hari ini, Kamis (12/6/2025), pesawat Air India yang dalam perjalanan dari Ahmedabad menuju London mengalami kecelakaan, menjadi insiden fatal pertama untuk model Boeing 787-8 Dreamliner sejak peluncurannya secara komersial pada tahun 2011. Pesawat Air India AI171 yang membawa 242 penumpang itu lepas landas dari Bandara Sardar Vallabhai Patel di Ahmedabad sekitar pukul 14.00 waktu setempat, namun beberapa menit setelahnya pesawat jatuh di area permukiman.",
                'foto' => 'pesawat.jpg',
                'created_at' => now(),
            ],
            [
                'admin_id' => 3,
                'judul' => "Teknologi Pemurnian Air Berstandar Industri Antariksa Masuk Pasar Indonesia",
                'slug' => Str::slug("Teknologi Pemurnian Air Berstandar Industri Antariksa Masuk Pasar Indonesia"),
                'deskripsi' => "Pemurnian air di Indonesia memasuki babak baru dengan peluncuran resmi Angel asal Tiongkok di bidang pemurnian air. Dengan pengalaman lebih dari tiga dekade dan sembilan sertifikasi internasional, Angel kini menghadirkan teknologi pemurnian air berstandar industri antariksa untuk kebutuhan rumah tangga, komersial, hingga fasilitas publik di seluruh Indonesia. Angel telah lama dikenal sebagai pelopor dalam teknologi pemurnian air. Melalui investasi besar dalam riset dan pengembangan, Angel menghadirkan berbagai teknologi inovatif seperti Membran Reverse Osmosis tahan lama hasil pengembangan sendiri, Teknologi Sterilisasi APCM, Teknologi Pemanas Instan Aliran Tinggi, serta Pompa Diafragma Ultra-Senyap. Air bersih adalah hak dasar setiap manusia. Melalui kehadiran Angel di Indonesia, kami menghadirkan teknologi pemurnian air berstandar antariksa untuk menjawab tantangan kualitas air saat ini dan di masa depan, kata Chairman & President Angel Group Kong Na dikutip Kamis (12/6/2025).",
                'foto' => 'air.jpg',
                'created_at' => now(),
            ],
            [
                'admin_id' => 3,
                'judul' => "Melihat Keunggulan Teknologi Militer Israel dan Iran",
                'slug' => Str::slug("Melihat Keunggulan Teknologi Militer Israel dan Iran"),
                'deskripsi' => "Israel unggul dalam teknologi militer, sementara Iran andalkan strategi asimetris dengan rudal, drone, dan jaringan proksi bersenjata regional.Semalam Iran diserang Israel. Serangan itu menargetkan fasilitas nuklir dan militer Iran. Karena serangan itu, pemimpin Garda Revolusi Iran Hossein Salami tewas. Ia merupakan kepala komandan Korps Garda Revolusi Islam (IRGC) Iran. Sebelum kematiannya, ia memegang peran penting dalam IRGC, menjabat sebagai panglima tertinggi.Di tengah eskalasi tersebut, muncul pertanyaan: siapa sebenarnya yang lebih unggul secara teknologi militer?. Mengutip analisis dari berbagai sumber terbuka termasuk Jane’s Defence Weekly, The Jerusalem Post, serta laporan intelijen Barat yang dikutip oleh BBC, Reuters, dan Axios, menunjukkan bahwa Israel secara signifikan lebih unggul dalam aspek teknologi militer dibandingkan Iran.",
                'foto' => 'perang.jpeg',
                'created_at' => now(),
            ],
            [
                'admin_id' => 3,
                'judul' => "Membedah Teknologi Pesawat Air India Boeing 787-8 Dreamliner yang Jatuh",
                'slug' => Str::slug("Membedah Teknologi Pesawat Air India Boeing 787-8 Dreamliner yang Jatuh"),
                'deskripsi' => "Pesawat Boeing 787-8 Dreamliner milik Air India diklaim memiliki mesin yang lebih cepat dibandingkan jet berbadan lebar lainnya dalam sejarah penerbangan.Pada hari ini, Kamis (12/6/2025), pesawat Air India yang dalam perjalanan dari Ahmedabad menuju London mengalami kecelakaan, menjadi insiden fatal pertama untuk model Boeing 787-8 Dreamliner sejak peluncurannya secara komersial pada tahun 2011. Pesawat Air India AI171 yang membawa 242 penumpang itu lepas landas dari Bandara Sardar Vallabhai Patel di Ahmedabad sekitar pukul 14.00 waktu setempat, namun beberapa menit setelahnya pesawat jatuh di area permukiman.",
                'foto' => 'pesawat.jpg',
                'created_at' => now(),
            ],
            [
                'admin_id' => 3,
                'judul' => "Teknologi Pemurnian Air Berstandar Industri Antariksa Masuk Pasar Indonesia",
                'slug' => Str::slug("Teknologi Pemurnian Air Berstandar Industri Antariksa Masuk Pasar Indonesia"),
                'deskripsi' => "Pemurnian air di Indonesia memasuki babak baru dengan peluncuran resmi Angel asal Tiongkok di bidang pemurnian air. Dengan pengalaman lebih dari tiga dekade dan sembilan sertifikasi internasional, Angel kini menghadirkan teknologi pemurnian air berstandar industri antariksa untuk kebutuhan rumah tangga, komersial, hingga fasilitas publik di seluruh Indonesia. Angel telah lama dikenal sebagai pelopor dalam teknologi pemurnian air. Melalui investasi besar dalam riset dan pengembangan, Angel menghadirkan berbagai teknologi inovatif seperti Membran Reverse Osmosis tahan lama hasil pengembangan sendiri, Teknologi Sterilisasi APCM, Teknologi Pemanas Instan Aliran Tinggi, serta Pompa Diafragma Ultra-Senyap. Air bersih adalah hak dasar setiap manusia. Melalui kehadiran Angel di Indonesia, kami menghadirkan teknologi pemurnian air berstandar antariksa untuk menjawab tantangan kualitas air saat ini dan di masa depan, kata Chairman & President Angel Group Kong Na dikutip Kamis (12/6/2025).",
                'foto' => 'air.jpg',
                'created_at' => now(),
            ],
            [
                'admin_id' => 3,
                'judul' => "Melihat Keunggulan Teknologi Militer Israel dan Iran",
                'slug' => Str::slug("Melihat Keunggulan Teknologi Militer Israel dan Iran"),
                'deskripsi' => "Israel unggul dalam teknologi militer, sementara Iran andalkan strategi asimetris dengan rudal, drone, dan jaringan proksi bersenjata regional.Semalam Iran diserang Israel. Serangan itu menargetkan fasilitas nuklir dan militer Iran. Karena serangan itu, pemimpin Garda Revolusi Iran Hossein Salami tewas. Ia merupakan kepala komandan Korps Garda Revolusi Islam (IRGC) Iran. Sebelum kematiannya, ia memegang peran penting dalam IRGC, menjabat sebagai panglima tertinggi.Di tengah eskalasi tersebut, muncul pertanyaan: siapa sebenarnya yang lebih unggul secara teknologi militer?. Mengutip analisis dari berbagai sumber terbuka termasuk Jane’s Defence Weekly, The Jerusalem Post, serta laporan intelijen Barat yang dikutip oleh BBC, Reuters, dan Axios, menunjukkan bahwa Israel secara signifikan lebih unggul dalam aspek teknologi militer dibandingkan Iran.",
                'foto' => 'perang.jpeg',
                'created_at' => now(),
            ],
            [
                'admin_id' => 3,
                'judul' => "Membedah Teknologi Pesawat Air India Boeing 787-8 Dreamliner yang Jatuh",
                'slug' => Str::slug("Membedah Teknologi Pesawat Air India Boeing 787-8 Dreamliner yang Jatuh"),
                'deskripsi' => "Pesawat Boeing 787-8 Dreamliner milik Air India diklaim memiliki mesin yang lebih cepat dibandingkan jet berbadan lebar lainnya dalam sejarah penerbangan.Pada hari ini, Kamis (12/6/2025), pesawat Air India yang dalam perjalanan dari Ahmedabad menuju London mengalami kecelakaan, menjadi insiden fatal pertama untuk model Boeing 787-8 Dreamliner sejak peluncurannya secara komersial pada tahun 2011. Pesawat Air India AI171 yang membawa 242 penumpang itu lepas landas dari Bandara Sardar Vallabhai Patel di Ahmedabad sekitar pukul 14.00 waktu setempat, namun beberapa menit setelahnya pesawat jatuh di area permukiman.",
                'foto' => 'pesawat.jpg',
                'created_at' => now(),
            ],
            [
                'admin_id' => 3,
                'judul' => "Teknologi Pemurnian Air Berstandar Industri Antariksa Masuk Pasar Indonesia",
                'slug' => Str::slug("Teknologi Pemurnian Air Berstandar Industri Antariksa Masuk Pasar Indonesia"),
                'deskripsi' => "Pemurnian air di Indonesia memasuki babak baru dengan peluncuran resmi Angel asal Tiongkok di bidang pemurnian air. Dengan pengalaman lebih dari tiga dekade dan sembilan sertifikasi internasional, Angel kini menghadirkan teknologi pemurnian air berstandar industri antariksa untuk kebutuhan rumah tangga, komersial, hingga fasilitas publik di seluruh Indonesia. Angel telah lama dikenal sebagai pelopor dalam teknologi pemurnian air. Melalui investasi besar dalam riset dan pengembangan, Angel menghadirkan berbagai teknologi inovatif seperti Membran Reverse Osmosis tahan lama hasil pengembangan sendiri, Teknologi Sterilisasi APCM, Teknologi Pemanas Instan Aliran Tinggi, serta Pompa Diafragma Ultra-Senyap. Air bersih adalah hak dasar setiap manusia. Melalui kehadiran Angel di Indonesia, kami menghadirkan teknologi pemurnian air berstandar antariksa untuk menjawab tantangan kualitas air saat ini dan di masa depan, kata Chairman & President Angel Group Kong Na dikutip Kamis (12/6/2025).",
                'foto' => 'air.jpg',
                'created_at' => now(),
            ],
            [
                'admin_id' => 3,
                'judul' => "Melihat Keunggulan Teknologi Militer Israel dan Iran",
                'slug' => Str::slug("Melihat Keunggulan Teknologi Militer Israel dan Iran"),
                'deskripsi' => "Israel unggul dalam teknologi militer, sementara Iran andalkan strategi asimetris dengan rudal, drone, dan jaringan proksi bersenjata regional.Semalam Iran diserang Israel. Serangan itu menargetkan fasilitas nuklir dan militer Iran. Karena serangan itu, pemimpin Garda Revolusi Iran Hossein Salami tewas. Ia merupakan kepala komandan Korps Garda Revolusi Islam (IRGC) Iran. Sebelum kematiannya, ia memegang peran penting dalam IRGC, menjabat sebagai panglima tertinggi.Di tengah eskalasi tersebut, muncul pertanyaan: siapa sebenarnya yang lebih unggul secara teknologi militer?. Mengutip analisis dari berbagai sumber terbuka termasuk Jane’s Defence Weekly, The Jerusalem Post, serta laporan intelijen Barat yang dikutip oleh BBC, Reuters, dan Axios, menunjukkan bahwa Israel secara signifikan lebih unggul dalam aspek teknologi militer dibandingkan Iran.",
                'foto' => 'perang.jpeg',
                'created_at' => now(),
            ],
            [
                'admin_id' => 3,
                'judul' => "Membedah Teknologi Pesawat Air India Boeing 787-8 Dreamliner yang Jatuh",
                'slug' => Str::slug("Membedah Teknologi Pesawat Air India Boeing 787-8 Dreamliner yang Jatuh"),
                'deskripsi' => "Pesawat Boeing 787-8 Dreamliner milik Air India diklaim memiliki mesin yang lebih cepat dibandingkan jet berbadan lebar lainnya dalam sejarah penerbangan.Pada hari ini, Kamis (12/6/2025), pesawat Air India yang dalam perjalanan dari Ahmedabad menuju London mengalami kecelakaan, menjadi insiden fatal pertama untuk model Boeing 787-8 Dreamliner sejak peluncurannya secara komersial pada tahun 2011. Pesawat Air India AI171 yang membawa 242 penumpang itu lepas landas dari Bandara Sardar Vallabhai Patel di Ahmedabad sekitar pukul 14.00 waktu setempat, namun beberapa menit setelahnya pesawat jatuh di area permukiman.",
                'foto' => 'pesawat.jpg',
                'created_at' => now(),
            ],
            [
                'admin_id' => 3,
                'judul' => "Teknologi Pemurnian Air Berstandar Industri Antariksa Masuk Pasar Indonesia",
                'slug' => Str::slug("Teknologi Pemurnian Air Berstandar Industri Antariksa Masuk Pasar Indonesia"),
                'deskripsi' => "Pemurnian air di Indonesia memasuki babak baru dengan peluncuran resmi Angel asal Tiongkok di bidang pemurnian air. Dengan pengalaman lebih dari tiga dekade dan sembilan sertifikasi internasional, Angel kini menghadirkan teknologi pemurnian air berstandar industri antariksa untuk kebutuhan rumah tangga, komersial, hingga fasilitas publik di seluruh Indonesia. Angel telah lama dikenal sebagai pelopor dalam teknologi pemurnian air. Melalui investasi besar dalam riset dan pengembangan, Angel menghadirkan berbagai teknologi inovatif seperti Membran Reverse Osmosis tahan lama hasil pengembangan sendiri, Teknologi Sterilisasi APCM, Teknologi Pemanas Instan Aliran Tinggi, serta Pompa Diafragma Ultra-Senyap. Air bersih adalah hak dasar setiap manusia. Melalui kehadiran Angel di Indonesia, kami menghadirkan teknologi pemurnian air berstandar antariksa untuk menjawab tantangan kualitas air saat ini dan di masa depan, kata Chairman & President Angel Group Kong Na dikutip Kamis (12/6/2025).",
                'foto' => 'air.jpg',
                'created_at' => now(),
            ],
        ]);
    }
}
