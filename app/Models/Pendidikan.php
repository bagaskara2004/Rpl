<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pendidikan extends Model
{
    protected $table = 'pendidikan';
    protected $fillable = ['user_id','nama_perguruan','pembimbing1','prodi','judul_ta','tahun_lulus','tahun_masuk','ipk','nim','jurusan','jenjang_pendidikan','ijasah','transkrip'];
}
