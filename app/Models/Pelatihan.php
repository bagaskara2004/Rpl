<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelatihan extends Model
{
     protected $table = 'pelatihan';
     protected $fillable = [
        'user_id',
        'penyelengara',
        'peran',
        'sertifikat',
        'durasi'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

}
