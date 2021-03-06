<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class course extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $fillable = [
        'courseDescription',
        'courseAcronym',
    ];
    protected $table = 'course';

    function student() {
        return $this->hasMany(student::class);
    }
}
