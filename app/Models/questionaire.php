<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class questionaire extends Model
{
    use HasFactory;

    protected $fillable = ['questionDescription', 'userTypeId'];
    protected $table = 'questionaire';
}
