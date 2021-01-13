<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class evaluationSummary extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $fillable = [
        'evaluatorId',
        'remarks',
        'evaluationDate',
        'userTypeId',
        'courseId',
        'report',
        'publish',
    ];

    protected $table = 'evaluation_summary';
    //hasMany

    public function userTypeId() {
        return $this-hasMany(userTypeId::class);
    }

    public function courseId() {
        return $this-hasMany(course::class);
    }
}
