<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PertanyaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pertanyaan')->insert([
            [
                'pertanyaan' => 'Apa motivasi Anda mengikuti program ini?',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'pertanyaan' => 'Apa pengalaman organisasi yang pernah Anda ikuti?',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'pertanyaan' => 'Apa keahlian utama yang Anda miliki?',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'pertanyaan' => 'Bagaimana cara Anda mengatasi masalah dalam tim?',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'pertanyaan' => 'Apa rencana Anda setelah lulus?',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
