<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('service_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->constrained()->onDelete('cascade');
            $table->string('locale')->index();
            $table->string('title');
            $table->string('slug');
            $table->text('description');
            $table->timestamps();

            $table->unique(['service_id', 'locale']);
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('service_translations');
    }
};
