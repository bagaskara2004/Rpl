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
        Schema::create('data_diri', function (Blueprint $table) {
            $table->id();
            // onDelete('cascade') akan menghapus data_diri jika user dihapus
            $table->foreignId('user_id')->unique()->constrained('users')->onDelete('cascade');
            $table->string('nama_lengkap');
            $table->date('tgl_lahir')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->enum('jenis_kelamin', ['laki-laki', 'perempuan'])->default('laki-laki');
            $table->string('email', 100)->unique();
            $table->string('hp', 20)->nullable();
            $table->string('tlp', 20)->nullable();
            $table->text('alamat')->nullable();
            $table->string('kab_kota', 100)->nullable();
            $table->string('provinsi', 100)->nullable();
            $table->string('kode_pos', 10)->nullable();
            $table->string('foto')->nullable();
            $table->string('cv')->nullable();
            $table->string('sumber_biaya_pendidikan', 100)->nullable();
            $table->string('nama_ibu')->nullable();
            $table->string('pekerjaan_ibu', 100)->nullable();
            $table->string('nama_ayah')->nullable();
            $table->string('pekerjaan_ayah', 100)->nullable();
            $table->enum('status', ['prosess', 'sukses','pending','gagal'])->default('prosess');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_diri');
    }
};
