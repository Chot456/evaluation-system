<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class student extends Model
{
    use HasFactory;

    protected $fillable = [
        'studId',
        'firstName', 
        'lastName', 
        'courseId', 
        'yearId', 
        'semesterId', 
        'password'
    ];

    protected $table = 'student';

}
