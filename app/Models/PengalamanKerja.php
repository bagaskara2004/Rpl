<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengalamanKerja extends Model
{
    protected $table = 'pengalaman_kerja';

    protected $fillable = [
        'user_id',
        'nama_perusahaan',
        'alamat_perusahaan',
        'kota_kab_perusahaan',
        'provinsi_perusahaan',
        'negara_perusahaan',
        'sejak',
        'sampai',
        'nama_staf',
        'posisi_staf',
        'tlp_staf',
        'email_staf',
        'posisi',
        'prestasi',
        'durasi',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
