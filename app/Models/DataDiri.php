<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataDiri extends Model
{
    protected $table = 'data_diri';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function pendidikan()
    {
        return $this->hasOne(Pendidikan::class, 'user_id', 'user_id');
    }
}
