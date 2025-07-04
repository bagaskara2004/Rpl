<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Berita extends Model
{
    protected $table = 'berita';
    protected $primaryKey = 'id';

    protected $fillable = [
        'admin_id',
        'judul',
        'slug',
        'deskripsi',
        'foto'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relationship dengan User (admin)
    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    // Auto generate slug ketika judul berubah
    public function setJudulAttribute($value)
    {
        $this->attributes['judul'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    // Scope untuk pencarian
    public function scopeSearch($query, $term)
    {
        return $query->where('judul', 'LIKE', "%{$term}%")
            ->orWhere('deskripsi', 'LIKE', "%{$term}%");
    }
}
