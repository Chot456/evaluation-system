<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class course extends Model
{
    use HasFactory;

    protected $fillable = [
        'courseDescription',
        'courseAcronym',
        'studId'
    ];
    protected $table = 'course';

    function student() {
        return $this->hasMany('App\Student')
    }
}
