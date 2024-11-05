<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('blog_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('blog_id')->constrained()->onDelete('cascade');
            $table->string('locale')->index();
            $table->string('title');
            $table->string('slug');
            $table->text('description_one')->nullable();
            $table->text('description_two')->nullable();
            $table->timestamps();

            $table->unique(['blog_id', 'locale']);
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('blog_translations');
    }
};
