<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pendidikan extends Model
{
    protected $table = 'pendidikan';
    use SoftDeletes;
    protected $fillable = ['user_id','nama_perguruan','pembimbing1','prodi','judul_ta','tahun_lulus','tahun_masuk','ipk','nim','jurusan','jenjang_pendidikan','ijasah','transkrip'];
}
