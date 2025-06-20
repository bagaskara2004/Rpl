<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AssessmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('assessment')->insert([
            [
                'user_id' => 1,
                'pertanyaan_id' => 1,
                'jawaban' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'pertanyaan_id' => 2,
                'jawaban' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'pertanyaan_id' => 3,
                'jawaban' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'pertanyaan_id' => 4,
                'jawaban' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'pertanyaan_id' => 5,
                'jawaban' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
