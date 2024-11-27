<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAchievementsTable extends Migration
{
    public function up()
    {
        Schema::create('achievements', function (Blueprint $table) {
            $table->id();
            $table->integer('years_of_experience');
            $table->integer('yearly_patients');
            $table->integer('monthly_patients');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('achievements');
    }
}
