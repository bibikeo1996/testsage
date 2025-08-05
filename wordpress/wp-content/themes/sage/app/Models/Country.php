<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = [
        'id',
        'name',
        'logo'
    ];

    public function teams()
    {
        return $this->hasMany(Team::class);
    }
} 