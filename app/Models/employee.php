<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\faculty;

class employee extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $fillable = [
        'employee_id',
        'firstname',
        'lastname',
        'email',
        'user_type_id',
    ];

    protected $table = 'employee';

    public function userType()
    {
        return $this->belongsTo(userType::class);
    }

    public function Comments()
    {
        return $this.hasMany(comment::class);
    }

    public function sections()
    {
        return $this.hasMany(section::class);
    }
    
}
