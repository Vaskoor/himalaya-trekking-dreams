<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('helicopter_tours', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('duration');
            $table->string('subtitle')->nullable();
            $table->string('altitude')->nullable();
            $table->string('badge')->nullable();
            $table->decimal('price', 10, 2);
            $table->string('group_size')->nullable();
            $table->string('best_season')->nullable();
            $table->string('hero_image')->nullable();
            $table->boolean('is_active')->default(true);
            $table->json('name');
            $table->json('short_description');
            $table->json('description');
            $table->json('narrative')->nullable();
            $table->json('safety_profile')->nullable();
            $table->json('highlights')->nullable();
            $table->json('stats')->nullable(); // e.g., [{value, label}]
            $table->json('places')->nullable(); // route waypoints
            $table->json('itinerary')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('helicopter_tours');
    }
};