<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posisi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengalaman_id')->constrained('pengalaman_kerja')->onDelete('cascade');
            $table->string('posisi');
            $table->string('prestasi')->nullable();
            $table->integer('durasi')->comment('Durasi dalam bulan')->nullable();
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posisi');
    }
};
