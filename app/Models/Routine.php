<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Routine extends Model
{
    protected $fillable = [
        'name',
        'description'
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function exercises(): BelongsToMany
    {
        return $this->belongsToMany(Exercise::class)->withPivot('sequence', 'target_sets', 'target_reps', 'rest_seconds')->withTimestamps();
    }
}
