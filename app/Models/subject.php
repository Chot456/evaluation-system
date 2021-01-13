<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class subject extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $fillable = [
        'subjCode',
        'subjDesc',
        'courseDescription',
        'unit'
    ];
    protected $table = 'subject';

    public function sections() {
        return $this->belongsTo(section::class);
    }

}
