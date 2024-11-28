<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guide extends Model
{
    protected $fillable = [
        'name',
        'expertise',
        'email',
    ];

    public function explorer()
    {
        return $this->belongsTo(Explorer::class);
    }
}
