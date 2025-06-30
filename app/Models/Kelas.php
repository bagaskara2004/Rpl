<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'kelas';

    protected $fillable = [
        'kelas'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relationships
    public function mataKuliah()
    {
        return $this->hasMany(MataKuliah::class);
    }

    public function pertemuan()
    {
        return $this->hasMany(Pertemuan::class);
    }
}
