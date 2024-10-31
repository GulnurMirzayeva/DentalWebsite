<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration
{
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('image_one');
            $table->string('image_two')->nullable();
//            $table->string('title');
//            $table->string('slug')->unique();
//            $table->text('description_one')->nullable();
//            $table->text('description_two')->nullable();
            $table->date('date');
            $table->integer('comments_count')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('blogs');
    }
}
