<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Assessment extends Model
{
    protected $table = 'assessment';
    use SoftDeletes;
    protected $fillable = ['user_id','pertanyaan_id','jawaban','status'];
}
