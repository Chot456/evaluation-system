<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class questionaireCategory extends Model
{
    use HasFactory;

    protected $fillable = ['categoryDescription'];
    protected $table = 'questionaire_category';
}
