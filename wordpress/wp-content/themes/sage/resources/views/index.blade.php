@extends('layouts.app')

@section('content')
<div class="sports-matches-container">
  <!-- Header với tabs -->
  <div class="matches-header">
    <div class="tabs">
      <button class="tab active" data-tab="all">Tất cả</button>
      <button class="tab" data-tab="live">Trực tiếp (<span id="live-count">{{ count($liveMatches) }}</span>)</button>
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
      @include('partials.matches-list', ['matches' => $matches, 'matchesByCompetition' => $matchesByCompetition, 'competitions' => $competitions])
    </div>

    <!-- Tab Live -->
    <div class="tab-content" id="tab-live">
      @include('partials.matches-list', ['matches' => $liveMatches, 'matchesByCompetition' => $liveMatchesByCompetition, 'competitions' => $competitions])
    </div>

    <!-- Tab Finished -->
    <div class="tab-content" id="tab-finished">
      @include('partials.matches-list', ['matches' => $finishedMatches, 'matchesByCompetition' => $finishedMatchesByCompetition, 'competitions' => $competitions])
    </div>

    <!-- Tab Schedule -->
    <div class="tab-content" id="tab-schedule">
      @include('partials.matches-list', ['matches' => $upcomingMatches, 'matchesByCompetition' => $upcomingMatchesByCompetition, 'competitions' => $competitions])
    </div>
  </div>
</div>
@endsection

@section('sidebar')
  @include('sections.sidebar')
@endsection
