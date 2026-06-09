<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('regions', function (Blueprint $table) {
            if (!Schema::hasColumn('regions', 'hero_image')) {
                $table->string('hero_image')->nullable();
            }
            if (!Schema::hasColumn('regions', 'short_description')) {
                $table->json('short_description')->nullable();
            }
            if (!Schema::hasColumn('regions', 'best_season')) {
                $table->string('best_season')->nullable();
            }
            if (!Schema::hasColumn('regions', 'difficulty')) {
                $table->string('difficulty')->nullable();
            }
            if (!Schema::hasColumn('regions', 'popular_treks')) {
                $table->json('popular_treks')->nullable();
            }
            if (!Schema::hasColumn('regions', 'highlights')) {
                $table->json('highlights')->nullable();
            }
            if (!Schema::hasColumn('regions', 'meta_title')) {
                $table->string('meta_title')->nullable();
            }
            if (!Schema::hasColumn('regions', 'meta_description')) {
                $table->text('meta_description')->nullable();
            }
            if (!Schema::hasColumn('regions', 'sort_order')) {
                $table->integer('sort_order')->default(0);
            }
            if (!Schema::hasColumn('regions', 'is_active')) {
                $table->boolean('is_active')->default(true);
            }
        });
    }

    public function down(): void
    {
        Schema::table('regions', function (Blueprint $table) {
            $table->dropColumn([
                'hero_image', 'short_description', 'best_season', 'difficulty',
                'popular_treks', 'highlights', 'meta_title', 'meta_description',
                'sort_order', 'is_active'
            ]);
        });
    }
};
