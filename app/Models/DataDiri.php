<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataDiri extends Model
{
    protected $table = 'data_diri';
    protected $fillable = ['user_id','nama_lengkap','tgl_lahir','tempat_lahir','jenis_kelamin','email','hp','tlp','alamat','kab_kota','provinsi','kode_pos','foto','cv','sumber_biaya_pendidikan','nama_ibu','pekerjaan_ibu','nama_ayah','pekerjaan_ayah','status'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function pendidikan()
    {
        return $this->hasOne(Pendidikan::class, 'user_id', 'user_id');
    }

    public function pengalamanKerja()
    {
        return $this->hasMany(\App\Models\PengalamanKerja::class, 'user_id', 'user_id');
    }
}
