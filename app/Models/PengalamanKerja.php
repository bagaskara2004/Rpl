<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengalamanKerja extends Model
{
    protected $table = 'pengalaman_kerja';

    protected $fillable = [
        'user_id',
        'nama_perusahaan',
        'posisi',
        'tahun_mulai',
        'tahun_selesai',
        'deskripsi_kerja',
        'gaji',
        'status_kerja'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
