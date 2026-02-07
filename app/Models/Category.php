<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = [
        'name',
        'icon_path'
    ];

    public function exercises(): HasMany
    {
        return $this->hasMany(Exercise::class);
    }
}
