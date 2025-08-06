<?php if(isset($matchesByCompetition) && count($matchesByCompetition) > 0): ?>
  <?php $__currentLoopData = $matchesByCompetition; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $competitionId => $matches): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php
      $competition = $competitions[$competitionId] ?? null;
    ?>
    
    <?php if($competition): ?>
      <div class="competition-group">
        <!-- Competition header -->
        <div class="competition-header">
          <div class="competition-info">
            <span class="star-icon">★</span>
            <span class="country-flag">🏳️</span>
            <span class="competition-name"><?php echo e($competition['name']); ?></span>
          </div>
        </div>

        <!-- Matches list -->
        <div class="matches-list">
          <?php $__currentLoopData = $matches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $match): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
              $homeScores = json_decode($match['home_scores'], true) ?: [0, 0, 0, 0, -1, 0, 0];
              $awayScores = json_decode($match['away_scores'], true) ?: [0, 0, 0, 0, -1, 0, 0];
            ?>
            
            <div class="match-row">
              <!-- Star icon -->
              <div class="match-star">
                <span class="star-icon">★</span>
              </div>

              <!-- Time and status -->
              <div class="match-time-status">
                <div class="match-time"><?php echo e(date('H:i', $match['match_time'])); ?></div>
                <div class="match-status <?php echo e($match['status_id'] == 8 ? 'finished' : ($match['status_id'] == 1 ? 'upcoming' : 'live')); ?>">
                  <?php if($match['status_id'] == 1): ?>
                    Sắp diễn ra
                  <?php elseif($match['status_id'] == 2): ?>
                    <?php echo e(rand(1, 45)); ?>'
                  <?php elseif($match['status_id'] == 3): ?>
                    Nghỉ giữa hiệp
                  <?php elseif($match['status_id'] == 4): ?>
                    <?php echo e(rand(46, 90)); ?>'
                  <?php elseif($match['status_id'] == 5): ?>
                    Hiệp phụ
                  <?php elseif($match['status_id'] == 7): ?>
                    Penalty
                  <?php elseif($match['status_id'] == 8): ?>
                    Kết thúc
                  <?php else: ?>
                    Trực tiếp
                  <?php endif; ?>
                </div>
              </div>

              <!-- Teams and score -->
              <div class="match-teams">
                <div class="team home-team">
                  <span class="team-logo">⚽</span>
                  <span class="team-name"><?php echo e($match['home_team_name']); ?></span>
                </div>
                <div class="match-score">
                  <?php echo e($homeScores[0] ?? 0); ?>-<?php echo e($awayScores[0] ?? 0); ?>

                </div>
                <div class="team away-team">
                  <span class="team-name"><?php echo e($match['away_team_name']); ?></span>
                  <span class="team-logo">⚽</span>
                </div>
              </div>

              <!-- Half time score -->
              <div class="half-time-score">
                HT <?php echo e($homeScores[1] ?? 0); ?>-<?php echo e($awayScores[1] ?? 0); ?>

              </div>

              <!-- Final score or other stats -->
              <div class="final-score">
                <?php echo e($homeScores[0] ?? 0); ?>-<?php echo e($awayScores[0] ?? 0); ?>

                <span class="arrow">→</span>
              </div>
            </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
      </div>
    <?php endif; ?>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php else: ?>
  <div class="no-matches">
    <p>Không có trận đấu nào.</p>
  </div>
<?php endif; ?> <?php /**PATH /var/www/html/wp-content/themes/sage/resources/views/partials/matches-list.blade.php ENDPATH**/ ?>