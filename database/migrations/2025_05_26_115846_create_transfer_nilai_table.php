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
        Schema::create('transfer_nilai', function (Blueprint $table) {
            $table->id();
            $table->foreignId('asesor_id')->constrained('users');
            $table->foreignId('kurikulum_id')->constrained('kurikulum');
            $table->foreignId('transkrip_id')->constrained('transkrip_nilai');
            $table->string('nilai', 5)->nullable();
            $table->text('catatan')->nullable();
            $table->integer('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transfer_nilai');
    }
};
