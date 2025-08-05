<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->string('id')->primary(); // UUID
            $table->string('competition_id'); // Foreign key to competitions
            $table->string('country_id'); // Foreign key to countries
            $table->string('name');
            $table->string('logo');
            $table->timestamps();
            
            $table->foreign('competition_id')->references('id')->on('competitions');
            $table->foreign('country_id')->references('id')->on('countries');
        });
    }

    public function down()
    {
        Schema::dropIfExists('teams');
    }
}; 