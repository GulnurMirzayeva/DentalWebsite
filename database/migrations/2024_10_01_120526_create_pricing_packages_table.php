<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePricingPackagesTable extends Migration
{
    public function up()
    {
        Schema::create('pricing_packages', function (Blueprint $table) {
            $table->id();
            $table->decimal('price', 10, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pricing_packages');
    }
}
