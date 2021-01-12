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
        'profId',
        'questionaireId',
        'rating',
    ];

    protected $table = 'evaluation';

    public function employees() {
        return $this.hasMany(employee::class);
    }

    public function questionaires() {
        return $this.hasMany(questionaire::class);
    }
}
