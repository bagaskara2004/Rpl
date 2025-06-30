<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TranskripNilai extends Model
{
    protected $table = 'transkrip_nilai';

    protected $fillable = [
        'user_id',
        'mata_kuliah',
        'sks',
        'nilai_huruf',
        'nilai_angka'
    ];

    /**
     * Get the user that owns the transkrip nilai.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
