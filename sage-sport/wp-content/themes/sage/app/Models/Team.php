<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = [
        'id',
        'competition_id',
        'country_id',
        'name',
        'logo'
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function competition()
    {
        return $this->belongsTo(Competition::class);
    }

    public function homeMatches()
    {
        return $this->hasMany(Match::class, 'home_team_id');
    }

    public function awayMatches()
    {
        return $this->hasMany(Match::class, 'away_team_id');
    }
} 