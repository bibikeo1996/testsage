@if(isset($matchesByCompetition) && count($matchesByCompetition) > 0)
  @foreach($matchesByCompetition as $competitionId => $matches)
    @php
      $competition = $competitions[$competitionId] ?? null;
    @endphp
    
    @if($competition)
      <div class="competition-group">
        <!-- Competition header -->
        <div class="competition-header">
          <div class="competition-info">
            <span class="star-icon">★</span>
            <span class="country-flag">🏳️</span>
            <span class="competition-name">{{ $competition['name'] }}</span>
          </div>
        </div>

        <!-- Matches list -->
        <div class="matches-list">
          @foreach($matches as $match)
            @php
              $homeScores = json_decode($match['home_scores'], true) ?: [0, 0, 0, 0, -1, 0, 0];
              $awayScores = json_decode($match['away_scores'], true) ?: [0, 0, 0, 0, -1, 0, 0];
            @endphp
            
            <div class="match-row">
              <!-- Star icon -->
              <div class="match-star">
                <span class="star-icon">★</span>
              </div>

              <!-- Time and status -->
              <div class="match-time-status">
                <div class="match-time">{{ date('H:i', $match['match_time']) }}</div>
                <div class="match-status {{ $match['status_id'] == 8 ? 'finished' : ($match['status_id'] == 1 ? 'upcoming' : 'live') }}">
                  @if($match['status_id'] == 1)
                    Sắp diễn ra
                  @elseif($match['status_id'] == 2)
                    {{ rand(1, 45) }}'
                  @elseif($match['status_id'] == 3)
                    Nghỉ giữa hiệp
                  @elseif($match['status_id'] == 4)
                    {{ rand(46, 90) }}'
                  @elseif($match['status_id'] == 5)
                    Hiệp phụ
                  @elseif($match['status_id'] == 7)
                    Penalty
                  @elseif($match['status_id'] == 8)
                    Kết thúc
                  @else
                    Trực tiếp
                  @endif
                </div>
              </div>

              <!-- Teams and score -->
              <div class="match-teams">
                <div class="team home-team">
                  <span class="team-logo">⚽</span>
                  <span class="team-name">{{ $match['home_team_name'] }}</span>
                </div>
                <div class="match-score">
                  {{ $homeScores[0] ?? 0 }}-{{ $awayScores[0] ?? 0 }}
                </div>
                <div class="team away-team">
                  <span class="team-name">{{ $match['away_team_name'] }}</span>
                  <span class="team-logo">⚽</span>
                </div>
              </div>

              <!-- Half time score -->
              <div class="half-time-score">
                HT {{ $homeScores[1] ?? 0 }}-{{ $awayScores[1] ?? 0 }}
              </div>

              <!-- Final score or other stats -->
              <div class="final-score">
                {{ $homeScores[0] ?? 0 }}-{{ $awayScores[0] ?? 0 }}
                <span class="arrow">→</span>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    @endif
  @endforeach
@else
  <div class="no-matches">
    <p>Không có trận đấu nào.</p>
  </div>
@endif 