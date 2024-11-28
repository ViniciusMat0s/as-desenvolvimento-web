<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Explorer extends Model
{
    protected $fillable = [
        'name',
        'identification',
        'email',
        'image',
        'duration_id',
        'guide_id',
        'artifact_id',
    ];

    public function expedition()
    {
        return $this->belongsTo(Expedition::class);
    }

    public function guide()
    {
        return $this->belongsTo(Guide::class);
    }

    public function artifact()
    {
        return $this->hasMany(Artifact::class);
    }
}
