<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class questionaire extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $fillable = ['questionDescription', 'userTypeId'];
    protected $table = 'questionaire';

    public function userTypes()
    {
        return $this.hasMany(user_type::class);
    }

    public function questionaires()
    {
        return $this.belongsTo(questionaire::class);
    }
}
