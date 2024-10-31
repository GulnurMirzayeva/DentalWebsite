<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAboutImagesTable extends Migration
{
    public function up()
    {
        Schema::create('about_images', function (Blueprint $table) {
            $table->id();
            $table->string('about_image');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('about_images');
    }
}
