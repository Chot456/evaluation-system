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
        'evaluator_id',
        'profId',
        'semester',
        'year',
    ];
    protected $table = 'section';

    // public function student() {
    //     return $this->hasMany('App\student', 'studId', 'studId');
    // }

    // public function subjects() {
    //     return $this->belongsTo('App\subject', 'subjCode', 'subjCode');                         
    // }

    public function employees() {
        return $this->hasMany(employee::class);
    }

    // public function semesters() {
    //     return $this->hasMany(semester::class);
    // }

    // public function years() {
    //     return $this->hasMany(year::class);
    // }

    
}
