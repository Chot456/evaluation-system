<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class section extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $fillable = [
        'section_code', 
        'subject_code',
        'studId',
        'profId',
        'semester',
        'year',
    ];
    protected $table = 'section';

    function student() {
        return $this->hasMany(student::class);
    }

    function subjects() {
        return $this->hasMany(subject::class);
    }

    function employees() {
        return $this->hasMany(employee::class);
    }

    function semesters() {
        return $this->hasMany(semester::class);
    }

    function years() {
        return $this->hasMany(year::class);
    }

    
}
