<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    protected $fillable = [
        'id',
        'competition_id',
        'home_team_id',
        'away_team_id',
        'status_id',
        'match_time',
        'home_scores',
        'away_scores'
    ];

    protected $casts = [
        'home_scores' => 'array',
        'away_scores' => 'array',
        'match_time' => 'integer'
    ];

    public function competition()
    {
        return $this->belongsTo(Competition::class);
    }

    public function homeTeam()
    {
        return $this->belongsTo(Team::class, 'home_team_id');
    }

    public function awayTeam()
    {
        return $this->belongsTo(Team::class, 'away_team_id');
    }

    public function getStatusTextAttribute()
    {
        $statuses = [
            1 => 'Not started',
            2 => 'First half',
            3 => 'Half-time',
            4 => 'Second half',
            5 => 'Overtime',
            6 => 'Overtime (deprecated)',
            7 => 'Penalty Shoot-out',
            8 => 'End',
            9 => 'Delay'
        ];

        return $statuses[$this->status_id] ?? 'Unknown';
    }
} 