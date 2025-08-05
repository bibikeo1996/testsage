<?php

namespace App\Controllers;

class MatchController
{
    private $wpdb;

    public function __construct()
    {
        global $wpdb;
        $this->wpdb = $wpdb;
    }

    public function index()
    {
        // Lấy tất cả trận đấu
        $matches = $this->getAllMatches();
        
        // Nhóm trận đấu theo competition
        $matchesByCompetition = $this->groupMatchesByCompetition($matches);
        
        // Lấy thông tin competitions
        $competitions = $this->getAllCompetitions();

        return [
            'matches' => $matches,
            'matchesByCompetition' => $matchesByCompetition,
            'competitions' => $competitions
        ];
    }

    public function getLiveMatches()
    {
        return $this->getMatchesByStatus([2, 4, 5, 7]);
    }

    public function getFinishedMatches()
    {
        return $this->getMatchesByStatus([8]);
    }

    public function getUpcomingMatches()
    {
        return $this->getMatchesByStatus([1]);
    }

    private function getAllMatches()
    {
        $sql = "
            SELECT m.*, 
                   c.name as competition_name,
                   ht.name as home_team_name,
                   at.name as away_team_name
            FROM matches m
            LEFT JOIN competitions c ON m.competition_id = c.id
            LEFT JOIN teams ht ON m.home_team_id = ht.id
            LEFT JOIN teams at ON m.away_team_id = at.id
            ORDER BY m.match_time DESC
        ";
        
        return $this->wpdb->get_results($sql, ARRAY_A);
    }

    private function getMatchesByStatus($statusIds)
    {
        $statusIdsStr = implode(',', array_map('intval', $statusIds));
        
        $sql = "
            SELECT m.*, 
                   c.name as competition_name,
                   ht.name as home_team_name,
                   at.name as away_team_name
            FROM matches m
            LEFT JOIN competitions c ON m.competition_id = c.id
            LEFT JOIN teams ht ON m.home_team_id = ht.id
            LEFT JOIN teams at ON m.away_team_id = at.id
            WHERE m.status_id IN ($statusIdsStr)
            ORDER BY m.match_time DESC
        ";
        
        return $this->wpdb->get_results($sql, ARRAY_A);
    }

    private function getAllCompetitions()
    {
        $sql = "SELECT * FROM competitions ORDER BY name";
        $competitions = $this->wpdb->get_results($sql, ARRAY_A);
        
        $result = [];
        foreach ($competitions as $competition) {
            $result[$competition['id']] = $competition;
        }
        
        return $result;
    }

    private function groupMatchesByCompetition($matches)
    {
        $grouped = [];
        foreach ($matches as $match) {
            $competitionId = $match['competition_id'];
            if (!isset($grouped[$competitionId])) {
                $grouped[$competitionId] = [];
            }
            $grouped[$competitionId][] = $match;
        }
        return $grouped;
    }
} 