<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class evaluationSummary extends Model
{
    use HasFactory;

    protected $fillable = [
        'evaluatorId',
        'remarks',
        'evaluationDate',
        'userTypeId',
        'collegeId',
    ];

    protected $table = 'evaluation_summary';
}
