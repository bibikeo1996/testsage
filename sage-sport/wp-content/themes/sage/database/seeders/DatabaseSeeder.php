<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;
use App\Models\Competition;
use App\Models\Team;
use App\Models\Match;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Tạo countries
        $countries = [
            ['id' => 'country-1', 'name' => 'England', 'logo' => 'england.png'],
            ['id' => 'country-2', 'name' => 'Spain', 'logo' => 'spain.png'],
            ['id' => 'country-3', 'name' => 'Germany', 'logo' => 'germany.png'],
            ['id' => 'country-4', 'name' => 'Italy', 'logo' => 'italy.png'],
        ];

        foreach ($countries as $country) {
            Country::create($country);
        }

        // Tạo competitions
        $competitions = [
            ['id' => 'comp-1', 'name' => 'Premier League', 'logo' => 'premier-league.png'],
            ['id' => 'comp-2', 'name' => 'La Liga', 'logo' => 'la-liga.png'],
            ['id' => 'comp-3', 'name' => 'Bundesliga', 'logo' => 'bundesliga.png'],
            ['id' => 'comp-4', 'name' => 'Serie A', 'logo' => 'serie-a.png'],
        ];

        foreach ($competitions as $competition) {
            Competition::create($competition);
        }

        // Tạo teams
        $teams = [
            ['id' => 'team-1', 'competition_id' => 'comp-1', 'country_id' => 'country-1', 'name' => 'Manchester United', 'logo' => 'man-utd.png'],
            ['id' => 'team-2', 'competition_id' => 'comp-1', 'country_id' => 'country-1', 'name' => 'Liverpool', 'logo' => 'liverpool.png'],
            ['id' => 'team-3', 'competition_id' => 'comp-1', 'country_id' => 'country-1', 'name' => 'Arsenal', 'logo' => 'arsenal.png'],
            ['id' => 'team-4', 'competition_id' => 'comp-1', 'country_id' => 'country-1', 'name' => 'Chelsea', 'logo' => 'chelsea.png'],
            ['id' => 'team-5', 'competition_id' => 'comp-2', 'country_id' => 'country-2', 'name' => 'Real Madrid', 'logo' => 'real-madrid.png'],
            ['id' => 'team-6', 'competition_id' => 'comp-2', 'country_id' => 'country-2', 'name' => 'Barcelona', 'logo' => 'barcelona.png'],
        ];

        foreach ($teams as $team) {
            Team::create($team);
        }

        // Tạo matches
        $matches = [
            [
                'id' => 'match-1',
                'competition_id' => 'comp-1',
                'home_team_id' => 'team-1',
                'away_team_id' => 'team-2',
                'status_id' => 8, // End
                'match_time' => time() - 3600,
                'home_scores' => [2, 1, 0, 2, 5, 0, 0],
                'away_scores' => [1, 0, 1, 1, 3, 0, 0]
            ],
            [
                'id' => 'match-2',
                'competition_id' => 'comp-1',
                'home_team_id' => 'team-3',
                'away_team_id' => 'team-4',
                'status_id' => 4, // Second half
                'match_time' => time(),
                'home_scores' => [1, 0, 0, 1, 4, 0, 0],
                'away_scores' => [0, 0, 0, 0, 2, 0, 0]
            ],
            [
                'id' => 'match-3',
                'competition_id' => 'comp-2',
                'home_team_id' => 'team-5',
                'away_team_id' => 'team-6',
                'status_id' => 1, // Not started
                'match_time' => time() + 7200,
                'home_scores' => [0, 0, 0, 0, -1, 0, 0],
                'away_scores' => [0, 0, 0, 0, -1, 0, 0]
            ],
        ];

        foreach ($matches as $match) {
            Match::create($match);
        }
    }
} 