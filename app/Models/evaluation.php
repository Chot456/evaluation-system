<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class evaluation extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $fillable = [
        'evaluatorId',
        'employee_id',
        'questionaireId',
        'rating',
        'remarks',
        'evaluationDate',
        'report',
        'publish',
        'userTypeDescription',
        'a1',
        'a2',
        'a3',
        'a4',
        'a5',
        'a6',
        'a7',
        'a8',
        'a9',
        'a10',
        'a11',
        'a12',
        'a13',
        'a14',
        'a15',
        'a16',
        'a17',
        'a18',
        'a19',
        'a20'
    ];

    protected $table = 'evaluation';

    public function employees() {
        return $this.hasMany(employee::class);
    }

    public function questionaires() {
        return $this.hasMany(questionaire::class);
    }
}
