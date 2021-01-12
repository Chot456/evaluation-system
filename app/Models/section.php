<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class section extends Model
{
    use HasFactory;
    protected $fillable = [
        'section_code', 
        'subject_code',
        'studId',
        'profId',
        'semester',
        'year',
    ];
    protected $table = 'section';
}
