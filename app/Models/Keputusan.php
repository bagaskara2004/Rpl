<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keputusan extends Model
{
    protected $table = 'keputusan';

    protected $fillable = [
        'user_id',
        'asesor_id',
        'status',
        'catatan'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function assessor()
    {
        return $this->belongsTo(User::class, 'asesor_id');
    }
}
