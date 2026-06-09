<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tour_packages', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('duration');
            $table->decimal('price', 10, 2);
            $table->string('difficulty')->nullable();
            $table->string('group_size')->nullable();
            $table->string('best_season')->nullable();
            $table->string('hero_image')->nullable();
            $table->boolean('is_active')->default(true);
            $table->string('icon')->nullable();
            $table->string('tag')->nullable();
            // translatable fields
            $table->json('name');
            $table->json('short_description');
            $table->json('description');
            $table->json('highlights')->nullable();
            $table->json('included')->nullable();
            $table->json('excluded')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tour_packages');
    }
};