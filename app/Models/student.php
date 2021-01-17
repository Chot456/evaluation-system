<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class student extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $fillable = [
        'studId',
        'firstName', 
        'lastName', 
        'user_id',
        'semesterDescription',
        'yearDescription',
        'courseDescription'
    ];

    protected $table = 'student';

    public function sections() {
        return $this->belongsTo(section::class);
    }

    public function years() {
        return $this->belongsTo(year::class);
    }

    public function course() {
        return $this->belongsTo(course::class);
    }
}
