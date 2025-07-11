<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_name',
        'name',
        'email',
        'password',
        'role_id',
        'foto',
        'block',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function dataDiri()
    {
        return $this->hasOne(DataDiri::class, 'user_id');
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function transkripNilai()
    {
        return $this->hasMany(TranskripNilai::class);
    }

    public function assessments()
    {
        return $this->hasMany(Assessment::class);
    }

    public function pendidikan()
    {
        return $this->hasOne(\App\Models\Pendidikan::class, 'user_id');
    }

    public function sisaMk()
    {
        return $this->hasMany(SisaMk::class);
    }

    public function pengalamanKerja()
    {
        return $this->hasMany(\App\Models\PengalamanKerja::class, 'user_id');
    }

    // Accessor for name attribute to maintain compatibility
    public function getNameAttribute()
    {
        return $this->user_name;
    }
}
