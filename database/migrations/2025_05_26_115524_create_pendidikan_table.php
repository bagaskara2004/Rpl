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
        Schema::create('pendidikan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('nama_perguruan')->nullable();
            $table->string('nim', 20)->nullable();
            $table->string('jenjang_pendidikan', 50)->nullable();
            $table->string('jurusan', 100)->nullable();
            $table->string('prodi', 100)->nullable();
            $table->date('tahun_masuk')->nullable();
            $table->date('tahun_lulus')->nullable();
            $table->decimal('ipk', 3, 2)->nullable();
            $table->text('judul_ta')->nullable();
            $table->string('pembimbing1')->nullable();
            $table->string('ijasah')->nullable();
            $table->string('transkrip')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendidikan');
    }
};
