<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransferNilai extends Model
{
    protected $table = 'transfer_nilai';
    use SoftDeletes;
    protected $fillable = [
        'asesor_id',
        'kurikulum_id',
        'transkrip_id',
        'nilai',
        'catatan',
        'status',
    ];

    public function asesor()
    {
        return $this->belongsTo(User::class, 'asesor_id');
    }

    public function kurikulum()
    {
        return $this->belongsTo(Kurikulum::class);
    }

    public function transkripNilai()
    {
        return $this->belongsTo(TranskripNilai::class, 'transkrip_id');
    }

    // Alternative alias for consistency
    public function transkrip()
    {
        return $this->belongsTo(TranskripNilai::class, 'transkrip_id');
    }

    // Get user through transkrip_nilai relationship
    public function user()
    {
        return $this->hasOneThrough(User::class, TranskripNilai::class, 'id', 'id', 'transkrip_id', 'user_id');
    }
}
