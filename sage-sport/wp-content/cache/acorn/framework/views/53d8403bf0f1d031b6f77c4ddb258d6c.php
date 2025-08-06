<?php $__env->startSection('content'); ?>
<div class="sports-matches-container">
  <!-- Header với tabs -->
  <div class="matches-header">
    <div class="tabs">
      <button class="tab active" data-tab="all">Tất cả</button>
      <button class="tab" data-tab="live">Trực tiếp (<span id="live-count"><?php echo e(count($liveMatches)); ?></span>)</button>
      <button class="tab" data-tab="finished">Đã kết thúc</button>
      <button class="tab" data-tab="schedule">Lịch thi đấu</button>
    </div>
    <div class="header-actions">
      <label class="checkbox-label">
        <input type="checkbox" id="sort-checkbox">
        <span>Xếp t</span>
      </label>
    </div>
  </div>

  <!-- Content area -->
  <div class="matches-content">
    <!-- Tab All -->
    <div class="tab-content active" id="tab-all">
      <?php echo $__env->make('partials.matches-list', ['matches' => $matches, 'matchesByCompetition' => $matchesByCompetition, 'competitions' => $competitions], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </div>

    <!-- Tab Live -->
    <div class="tab-content" id="tab-live">
      <?php echo $__env->make('partials.matches-list', ['matches' => $liveMatches, 'matchesByCompetition' => $liveMatchesByCompetition, 'competitions' => $competitions], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </div>

    <!-- Tab Finished -->
    <div class="tab-content" id="tab-finished">
      <?php echo $__env->make('partials.matches-list', ['matches' => $finishedMatches, 'matchesByCompetition' => $finishedMatchesByCompetition, 'competitions' => $competitions], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </div>

    <!-- Tab Schedule -->
    <div class="tab-content" id="tab-schedule">
      <?php echo $__env->make('partials.matches-list', ['matches' => $upcomingMatches, 'matchesByCompetition' => $upcomingMatchesByCompetition, 'competitions' => $competitions], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('sidebar'); ?>
  <?php echo $__env->make('sections.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/wp-content/themes/sage/resources/views/index.blade.php ENDPATH**/ ?>