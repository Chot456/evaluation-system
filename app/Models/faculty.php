<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class faculty extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $fillable = [
        'faculty_name',
        'employee_id',
    ];

    protected $table = 'faculty';

    public function employees()
    {
        return $this.hasMany(employee::class);
    }

}
