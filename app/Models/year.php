<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class year extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $fillable = ['yearDescription'];
    protected $table = 'year';
}
