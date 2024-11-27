<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHeaderImagesTable extends Migration
{
    public function up()
    {
        Schema::create('header_images', function (Blueprint $table) {
            $table->id();
            $table->string('header_image');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('header_images');
    }
}
