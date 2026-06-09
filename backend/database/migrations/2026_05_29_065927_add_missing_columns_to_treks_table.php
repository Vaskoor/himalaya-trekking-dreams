<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('treks', function (Blueprint $table) {
            if (!Schema::hasColumn('treks', 'hero_image')) {
                $table->string('hero_image')->nullable();
            }
            if (!Schema::hasColumn('treks', 'sort_order')) {
                $table->integer('sort_order')->default(0);
            }
            // If is_featured already exists, skip; else add
            if (!Schema::hasColumn('treks', 'is_featured')) {
                $table->boolean('is_featured')->default(false);
            }
        });
    }

    public function down(): void
    {
        Schema::table('treks', function (Blueprint $table) {
            $table->dropColumn(['hero_image', 'sort_order', 'is_featured']);
        });
    }
};
