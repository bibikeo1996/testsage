<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('matches', function (Blueprint $table) {
            $table->string('id')->primary(); // UUID
            $table->string('competition_id'); // Foreign key to competitions
            $table->string('home_team_id'); // Foreign key to teams
            $table->string('away_team_id'); // Foreign key to teams
            $table->integer('status_id'); // 1-9 status enum
            $table->bigInteger('match_time'); // Unix timestamp
            $table->json('home_scores'); // Array [score, halftime, red_cards, yellow_cards, corners, overtime, penalty]
            $table->json('away_scores'); // Array [score, halftime, red_cards, yellow_cards, corners, overtime, penalty]
            $table->timestamps();
            
            $table->foreign('competition_id')->references('id')->on('competitions');
            $table->foreign('home_team_id')->references('id')->on('teams');
            $table->foreign('away_team_id')->references('id')->on('teams');
        });
    }

    public function down()
    {
        Schema::dropIfExists('matches');
    }
}; 