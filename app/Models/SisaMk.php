<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SisaMk extends Model
{
    protected $table = 'sisa_mk';

    protected $fillable = [
        'user_id',
        'kurikulum_id'
    ];

    /**
     * Get the user that owns the sisa mata kuliah.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the kurikulum that belongs to the sisa mata kuliah.
     */
    public function kurikulum(): BelongsTo
    {
        return $this->belongsTo(Kurikulum::class);
    }
}
