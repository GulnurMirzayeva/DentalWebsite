<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComplaintsSuggestionsTable extends Migration
{
    public function up()
    {
        Schema::create('complaints_suggestions', function (Blueprint $table) {
            $table->id();
            $table->string('fullname');
            $table->string('phone');
            $table->string('email')->nullable();
            $table->string('subject');
            $table->text('message');
            $table->boolean('viewed')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('complaints_suggestions');
    }
}
