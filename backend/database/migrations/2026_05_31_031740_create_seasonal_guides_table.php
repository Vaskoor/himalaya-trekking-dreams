<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up() {
        Schema::create('seasonal_guides', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->json('title');
            $table->json('excerpt');
            $table->json('content');
            $table->string('season')->nullable();
            $table->string('month_range')->nullable();
            $table->string('featured_image')->nullable();
            $table->json('weather_summary')->nullable();
            $table->json('recommended_treks')->nullable();
            $table->json('recommended_activities')->nullable();
            $table->json('pros')->nullable();
            $table->json('cons')->nullable();
            $table->string('author')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->boolean('is_active')->default(true);
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }
    public function down() { Schema::dropIfExists('seasonal_guides'); }
};
