<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class evaluation extends Model
{
    use HasFactory;

    protected $fillable = [
        'evaluatorId',
        'profId',
        'questionaireId',
        'rating',
    ];

    protected $table = 'evaluation';
}
