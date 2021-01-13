<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class questionaireCategory extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $fillable = ['questionCategoryDesc'];
    protected $table = 'questionaire_category';

    public function questionCategory()
    {
        return $this.hasMany(questionaire::class);
    }
    
}
