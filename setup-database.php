<?php
/**
 * Database Setup Script for Sports Website
 * Run this file in WordPress context
 */

// Include WordPress
require_once('wp-load.php');

global $wpdb;

echo "=== Setting up Sports Database ===\n";

// Create tables
$tables = [
    'countries' => "
        CREATE TABLE IF NOT EXISTS countries (
            id VARCHAR(255) PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            logo VARCHAR(255),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )
    ",
    
    'competitions' => "
        CREATE TABLE IF NOT EXISTS competitions (
            id VARCHAR(255) PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            logo VARCHAR(255),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )
    ",
    
    'teams' => "
        CREATE TABLE IF NOT EXISTS teams (
            id VARCHAR(255) PRIMARY KEY,
            competition_id VARCHAR(255),
            country_id VARCHAR(255),
            name VARCHAR(255) NOT NULL,
            logo VARCHAR(255),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            FOREIGN KEY (competition_id) REFERENCES competitions(id),
            FOREIGN KEY (country_id) REFERENCES countries(id)
        )
    ",
    
    'matches' => "
        CREATE TABLE IF NOT EXISTS matches (
            id VARCHAR(255) PRIMARY KEY,
            competition_id VARCHAR(255),
            home_team_id VARCHAR(255),
            away_team_id VARCHAR(255),
            status_id INT,
            match_time BIGINT,
            home_scores JSON,
            away_scores JSON,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            FOREIGN KEY (competition_id) REFERENCES competitions(id),
            FOREIGN KEY (home_team_id) REFERENCES teams(id),
            FOREIGN KEY (away_team_id) REFERENCES teams(id)
        )
    "
];

// Create tables
foreach ($tables as $table => $sql) {
    $result = $wpdb->query($sql);
    if ($result !== false) {
        echo "✓ Table '$table' created successfully\n";
    } else {
        echo "✗ Error creating table '$table': " . $wpdb->last_error . "\n";
    }
}

// Clear existing data
$wpdb->query("DELETE FROM matches");
$wpdb->query("DELETE FROM teams");
$wpdb->query("DELETE FROM competitions");
$wpdb->query("DELETE FROM countries");

// Insert sample data
echo "\n=== Inserting Sample Data ===\n";

// Countries
$countries = [
    ['id' => 'country-1', 'name' => 'Algeria', 'logo' => 'algeria.png'],
    ['id' => 'country-2', 'name' => 'Ấn Độ', 'logo' => 'india.png'],
    ['id' => 'country-3', 'name' => 'Bangladesh', 'logo' => 'bangladesh.png'],
    ['id' => 'country-4', 'name' => 'England', 'logo' => 'england.png'],
    ['id' => 'country-5', 'name' => 'Spain', 'logo' => 'spain.png'],
];

foreach ($countries as $country) {
    $result = $wpdb->insert('countries', $country);
    if ($result !== false) {
        echo "✓ Country '{$country['name']}' inserted\n";
    } else {
        echo "✗ Error inserting country '{$country['name']}'\n";
    }
}

// Competitions
$competitions = [
    ['id' => 'comp-1', 'name' => 'Algeria: Giải bóng đá nữ Algeria', 'logo' => 'algeria-women.png'],
    ['id' => 'comp-2', 'name' => 'Algeria: Liga U21 Youth Algeria', 'logo' => 'algeria-u21.png'],
    ['id' => 'comp-3', 'name' => 'Ấn Độ: Siêu cúp Ân Độ - Bảng đầu A', 'logo' => 'india-super-cup.png'],
    ['id' => 'comp-4', 'name' => 'Bangladesh: Giải ngoại hạng Bangladesh - Vòng 4', 'logo' => 'bangladesh-premier.png'],
    ['id' => 'comp-5', 'name' => 'England: Premier League', 'logo' => 'premier-league.png'],
    ['id' => 'comp-6', 'name' => 'Spain: La Liga', 'logo' => 'la-liga.png'],
];

foreach ($competitions as $competition) {
    $result = $wpdb->insert('competitions', $competition);
    if ($result !== false) {
        echo "✓ Competition '{$competition['name']}' inserted\n";
    } else {
        echo "✗ Error inserting competition '{$competition['name']}'\n";
    }
}

// Teams
$teams = [
    // Algeria Women
    ['id' => 'team-1', 'competition_id' => 'comp-1', 'country_id' => 'country-1', 'name' => 'CLB nữ Akbou', 'logo' => 'akbou.png'],
    ['id' => 'team-2', 'competition_id' => 'comp-1', 'country_id' => 'country-1', 'name' => 'Afak Relizane(w)', 'logo' => 'afak.png'],
    ['id' => 'team-3', 'competition_id' => 'comp-1', 'country_id' => 'country-1', 'name' => 'CLB nữ Jf Khroub', 'logo' => 'khroub.png'],
    ['id' => 'team-4', 'competition_id' => 'comp-1', 'country_id' => 'country-1', 'name' => 'ASE Alger Centre (w)', 'logo' => 'alger-centre.png'],
    ['id' => 'team-5', 'competition_id' => 'comp-1', 'country_id' => 'country-1', 'name' => 'CR Belouizdad (W)', 'logo' => 'belouizdad.png'],
    ['id' => 'team-6', 'competition_id' => 'comp-1', 'country_id' => 'country-1', 'name' => 'ASE Bejala (W)', 'logo' => 'bejala.png'],
    
    // Algeria U21
    ['id' => 'team-7', 'competition_id' => 'comp-2', 'country_id' => 'country-1', 'name' => 'Saoura U21', 'logo' => 'saoura-u21.png'],
    ['id' => 'team-8', 'competition_id' => 'comp-2', 'country_id' => 'country-1', 'name' => 'Kabylie U21', 'logo' => 'kabylie-u21.png'],
    
    // India
    ['id' => 'team-9', 'competition_id' => 'comp-3', 'country_id' => 'country-2', 'name' => 'Hyderabad', 'logo' => 'hyderabad.png'],
    ['id' => 'team-10', 'competition_id' => 'comp-3', 'country_id' => 'country-2', 'name' => 'Sreenidi Deccan', 'logo' => 'sreenidi.png'],
    
    // Bangladesh
    ['id' => 'team-11', 'competition_id' => 'comp-4', 'country_id' => 'country-3', 'name' => 'Fortis Limited', 'logo' => 'fortis.png'],
    ['id' => 'team-12', 'competition_id' => 'comp-4', 'country_id' => 'country-3', 'name' => 'Rahmatgonj MFS', 'logo' => 'rahmatgonj.png'],
    ['id' => 'team-13', 'competition_id' => 'comp-4', 'country_id' => 'country-3', 'name' => 'Sheikh Jamal', 'logo' => 'sheikh-jamal.png'],
    ['id' => 'team-14', 'competition_id' => 'comp-4', 'country_id' => 'country-3', 'name' => 'Bashundhara Kings', 'logo' => 'bashundhara.png'],
    
    // England
    ['id' => 'team-15', 'competition_id' => 'comp-5', 'country_id' => 'country-4', 'name' => 'Manchester United', 'logo' => 'man-utd.png'],
    ['id' => 'team-16', 'competition_id' => 'comp-5', 'country_id' => 'country-4', 'name' => 'Liverpool', 'logo' => 'liverpool.png'],
    ['id' => 'team-17', 'competition_id' => 'comp-5', 'country_id' => 'country-4', 'name' => 'Arsenal', 'logo' => 'arsenal.png'],
    ['id' => 'team-18', 'competition_id' => 'comp-5', 'country_id' => 'country-4', 'name' => 'Chelsea', 'logo' => 'chelsea.png'],
    
    // Spain
    ['id' => 'team-19', 'competition_id' => 'comp-6', 'country_id' => 'country-5', 'name' => 'Real Madrid', 'logo' => 'real-madrid.png'],
    ['id' => 'team-20', 'competition_id' => 'comp-6', 'country_id' => 'country-5', 'name' => 'Barcelona', 'logo' => 'barcelona.png'],
];

foreach ($teams as $team) {
    $result = $wpdb->insert('teams', $team);
    if ($result !== false) {
        echo "✓ Team '{$team['name']}' inserted\n";
    } else {
        echo "✗ Error inserting team '{$team['name']}'\n";
    }
}

// Matches - Live matches (status 2, 4, 5, 7)
$liveMatches = [
    [
        'id' => 'match-1',
        'competition_id' => 'comp-1',
        'home_team_id' => 'team-1',
        'away_team_id' => 'team-2',
        'status_id' => 4, // Second half
        'match_time' => time() - 3600,
        'home_scores' => json_encode([1, 1, 0, 2, 5, 0, 0]),
        'away_scores' => json_encode([0, 0, 1, 1, 3, 0, 0])
    ],
    [
        'id' => 'match-2',
        'competition_id' => 'comp-1',
        'home_team_id' => 'team-3',
        'away_team_id' => 'team-4',
        'status_id' => 3, // Half time
        'match_time' => time() - 1800,
        'home_scores' => json_encode([2, 2, 0, 1, 4, 0, 0]),
        'away_scores' => json_encode([0, 0, 0, 0, 2, 0, 0])
    ],
    [
        'id' => 'match-3',
        'competition_id' => 'comp-1',
        'home_team_id' => 'team-5',
        'away_team_id' => 'team-6',
        'status_id' => 3, // Half time
        'match_time' => time() - 1200,
        'home_scores' => json_encode([1, 1, 0, 1, 4, 0, 0]),
        'away_scores' => json_encode([2, 2, 1, 1, 3, 0, 0])
    ],
    [
        'id' => 'match-4',
        'competition_id' => 'comp-2',
        'home_team_id' => 'team-7',
        'away_team_id' => 'team-8',
        'status_id' => 4, // Second half
        'match_time' => time() - 2400,
        'home_scores' => json_encode([0, 0, 0, 0, 2, 0, 0]),
        'away_scores' => json_encode([4, 2, 1, 2, 6, 0, 0])
    ],
    [
        'id' => 'match-5',
        'competition_id' => 'comp-4',
        'home_team_id' => 'team-11',
        'away_team_id' => 'team-12',
        'status_id' => 4, // Second half
        'match_time' => time() - 900,
        'home_scores' => json_encode([1, 1, 0, 1, 4, 0, 0]),
        'away_scores' => json_encode([2, 1, 1, 0, 3, 0, 0])
    ],
    [
        'id' => 'match-6',
        'competition_id' => 'comp-4',
        'home_team_id' => 'team-13',
        'away_team_id' => 'team-14',
        'status_id' => 4, // Second half
        'match_time' => time() - 600,
        'home_scores' => json_encode([0, 0, 0, 0, 2, 0, 0]),
        'away_scores' => json_encode([0, 0, 0, 0, 2, 0, 0])
    ],
];

// Matches - Finished matches (status 8)
$finishedMatches = [
    [
        'id' => 'match-7',
        'competition_id' => 'comp-3',
        'home_team_id' => 'team-9',
        'away_team_id' => 'team-10',
        'status_id' => 8, // Finished
        'match_time' => time() - 7200,
        'home_scores' => json_encode([1, 0, 0, 1, 4, 0, 0]),
        'away_scores' => json_encode([4, 4, 1, 2, 6, 0, 0])
    ],
    [
        'id' => 'match-8',
        'competition_id' => 'comp-5',
        'home_team_id' => 'team-15',
        'away_team_id' => 'team-16',
        'status_id' => 8, // Finished
        'match_time' => time() - 10800,
        'home_scores' => json_encode([2, 1, 0, 2, 5, 0, 0]),
        'away_scores' => json_encode([1, 0, 1, 1, 3, 0, 0])
    ],
    [
        'id' => 'match-9',
        'competition_id' => 'comp-5',
        'home_team_id' => 'team-17',
        'away_team_id' => 'team-18',
        'status_id' => 8, // Finished
        'match_time' => time() - 14400,
        'home_scores' => json_encode([3, 2, 0, 1, 6, 0, 0]),
        'away_scores' => json_encode([1, 0, 1, 2, 4, 0, 0])
    ],
    [
        'id' => 'match-10',
        'competition_id' => 'comp-6',
        'home_team_id' => 'team-19',
        'away_team_id' => 'team-20',
        'status_id' => 8, // Finished
        'match_time' => time() - 18000,
        'home_scores' => json_encode([2, 1, 0, 1, 5, 0, 0]),
        'away_scores' => json_encode([2, 1, 1, 0, 4, 0, 0])
    ],
];

// Matches - Upcoming matches (status 1)
$upcomingMatches = [
    [
        'id' => 'match-11',
        'competition_id' => 'comp-5',
        'home_team_id' => 'team-15',
        'away_team_id' => 'team-17',
        'status_id' => 1, // Not started
        'match_time' => time() + 3600,
        'home_scores' => json_encode([0, 0, 0, 0, -1, 0, 0]),
        'away_scores' => json_encode([0, 0, 0, 0, -1, 0, 0])
    ],
    [
        'id' => 'match-12',
        'competition_id' => 'comp-6',
        'home_team_id' => 'team-19',
        'away_team_id' => 'team-20',
        'status_id' => 1, // Not started
        'match_time' => time() + 7200,
        'home_scores' => json_encode([0, 0, 0, 0, -1, 0, 0]),
        'away_scores' => json_encode([0, 0, 0, 0, -1, 0, 0])
    ],
];

// Insert all matches
$allMatches = array_merge($liveMatches, $finishedMatches, $upcomingMatches);

foreach ($allMatches as $match) {
    $result = $wpdb->insert('matches', $match);
    if ($result !== false) {
        echo "✓ Match '{$match['id']}' inserted\n";
    } else {
        echo "✗ Error inserting match '{$match['id']}'\n";
    }
}

echo "\n=== Database Setup Complete ===\n";
echo "Live matches: " . count($liveMatches) . "\n";
echo "Finished matches: " . count($finishedMatches) . "\n";
echo "Upcoming matches: " . count($upcomingMatches) . "\n";
echo "Total matches: " . count($allMatches) . "\n";
echo "You can now access the sports website at: http://localhost:8000\n";
?> 