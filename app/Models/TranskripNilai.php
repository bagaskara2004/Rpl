<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TranskripNilai extends Model
{
    protected $table = 'transkrip_nilai';
    protected $fillable = ['user_id','mata_kuliah','sks','nilai_angka','nilai_huruf'];
}
