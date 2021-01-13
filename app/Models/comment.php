<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $fillable = [
        'comment',
        'employee_id',
    ];
    protected $table = 'comment';

    public function Users()
    {
        return $this.belongsTo(employee::class);
    }
}
