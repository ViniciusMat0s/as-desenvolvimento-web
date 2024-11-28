<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expedition extends Model
{
    protected $fillable = [
        'name',
        'duration',
        'guide_id',
    ];

    public function explorer()
    {
        return $this->belongsTo(Explorer::class);
    }
}
