<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Skill extends Model
{
    protected $fillable = [
        'skill_name',
        'level',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo('App\User');
    }
}
