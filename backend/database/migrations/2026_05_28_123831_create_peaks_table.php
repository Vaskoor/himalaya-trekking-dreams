<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('peaks', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('duration');
            $table->integer('max_altitude');
            $table->string('difficulty');
            $table->string('best_season');
            $table->decimal('price', 10, 2);
            $table->string('group_size');
            $table->string('start_point')->nullable();
            $table->string('end_point')->nullable();
            $table->string('start_end')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->string('hero_image')->nullable();
            $table->string('icon')->nullable();
            $table->string('tag')->nullable();
            $table->json('name');
            $table->json('short_description');
            $table->json('description');
            $table->json('tagline')->nullable();
            $table->json('highlights')->nullable();
            $table->json('places')->nullable();
            $table->json('included')->nullable();
            $table->json('excluded')->nullable();
            $table->json('itinerary')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('peaks');
    }
};