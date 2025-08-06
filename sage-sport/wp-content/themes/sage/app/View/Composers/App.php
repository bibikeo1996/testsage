<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;
use App\Controllers\MatchController;

class App extends Composer
{
    protected static $views = [
        'index', // ← Tương ứng với: resources/views/index.blade.php
    ];

    public function with()
    {
        return [
            'matches' => $this->getMatches(),
            'matchesByCompetition' => $this->getMatchesByCompetition(),
            'competitions' => $this->getCompetitions(),
            'liveMatches' => $this->getLiveMatches(),
            'liveMatchesByCompetition' => $this->getLiveMatchesByCompetition(),
            'finishedMatches' => $this->getFinishedMatches(),
            'finishedMatchesByCompetition' => $this->getFinishedMatchesByCompetition(),
            'upcomingMatches' => $this->getUpcomingMatches(),
            'upcomingMatchesByCompetition' => $this->getUpcomingMatchesByCompetition(),
        ];
    }

    private function getMatches()
    {
        try {
            $controller = new MatchController();
            $data = $controller->index();
            return $data['matches'] ?? [];
        } catch (\Exception $e) {
            return [];
        }
    }

    private function getMatchesByCompetition()
    {
        try {
            $controller = new MatchController();
            $data = $controller->index();
            return $data['matchesByCompetition'] ?? [];
        } catch (\Exception $e) {
            return [];
        }
    }

    private function getCompetitions()
    {
        try {
            $controller = new MatchController();
            $data = $controller->index();
            return $data['competitions'] ?? [];
        } catch (\Exception $e) {
            return [];
        }
    }

    private function getLiveMatches()
    {
        try {
            $controller = new MatchController();
            return $controller->getLiveMatches();
        } catch (\Exception $e) {
            return [];
        }
    }

    private function getLiveMatchesByCompetition()
    {
        try {
            $matches = $this->getLiveMatches();
            return $this->groupMatchesByCompetition($matches);
        } catch (\Exception $e) {
            return [];
        }
    }

    private function getFinishedMatches()
    {
        try {
            $controller = new MatchController();
            return $controller->getFinishedMatches();
        } catch (\Exception $e) {
            return [];
        }
    }

    private function getFinishedMatchesByCompetition()
    {
        try {
            $matches = $this->getFinishedMatches();
            return $this->groupMatchesByCompetition($matches);
        } catch (\Exception $e) {
            return [];
        }
    }

    private function getUpcomingMatches()
    {
        try {
            $controller = new MatchController();
            return $controller->getUpcomingMatches();
        } catch (\Exception $e) {
            return [];
        }
    }

    private function getUpcomingMatchesByCompetition()
    {
        try {
            $matches = $this->getUpcomingMatches();
            return $this->groupMatchesByCompetition($matches);
        } catch (\Exception $e) {
            return [];
        }
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
