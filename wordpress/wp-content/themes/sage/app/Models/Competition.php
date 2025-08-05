<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Competition extends Model
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

    public function matches()
    {
        return $this->hasMany(Match::class);
    }
} 