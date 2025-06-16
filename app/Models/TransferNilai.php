<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransferNilai extends Model
{
    protected $table = 'transfer_nilai';
    protected $fillable = [
        'asesor_id',
        'kurikulum_id',
        'transkrip_id',
        'nilai',
        'catatan',
        'status',
    ];
}
