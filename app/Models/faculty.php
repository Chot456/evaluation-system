<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class faculty extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $fillable = [
        'department_id',
        'instructor_id',
    ];

    protected $table = 'faculty';

    public function department()
    {
        return $this.hasMany(department::class);
    }

    public function employees()
    {
        return $this.hasMany(employee::class);
    }

}
