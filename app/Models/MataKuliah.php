<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    protected $table = 'mata_kuliah';

    protected $fillable = [
        'dosen_id',
        'kelas_id',
        'mata_kuliah',
        'semester',
        'tahun'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relationships
    public function dosen()
    {
        return $this->belongsTo(User::class, 'dosen_id');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function pertemuan()
    {
        return $this->hasMany(Pertemuan::class);
    }
}
