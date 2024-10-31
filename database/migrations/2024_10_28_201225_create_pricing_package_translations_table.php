<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pricing_package_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pricing_package_id')->constrained()->onDelete('cascade');
            $table->string('locale')->index();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('service_name'); // Multilingual service name
            $table->timestamps();

            $table->unique(['pricing_package_id', 'locale']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pricing_package_translations');
    }
};
