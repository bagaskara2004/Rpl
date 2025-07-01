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
        Schema::create('pengalaman_kerja', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('nama_perusahaan');
            $table->text('alamat_perusahaan');
            $table->string('kota_kab_perusahaan', 100);
            $table->string('provinsi_perusahaan', 100);
            $table->string('negara_perusahaan', 100);
            $table->date('sejak');
            $table->date('sampai')->nullable();
            $table->string('nama_staf', 255)->nullable();
            $table->string('posisi_staf', 100)->nullable();
            $table->string('tlp_staf', 20)->nullable();
            $table->string('email_staf', 100)->nullable();
            $table->string('posisi');
            $table->string('prestasi');
            $table->integer('durasi')->comment('Durasi dalam bulan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengalaman_kerja');
    }
};
