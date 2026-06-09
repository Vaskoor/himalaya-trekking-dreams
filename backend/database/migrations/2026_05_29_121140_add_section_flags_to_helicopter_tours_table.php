<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('helicopter_tours', function (Blueprint $table) {
            if (!Schema::hasColumn('helicopter_tours', 'is_featured')) {
                $table->boolean('is_featured')->default(false);
            }
            if (!Schema::hasColumn('helicopter_tours', 'is_popular')) {
                $table->boolean('is_popular')->default(false);
            }
            if (!Schema::hasColumn('helicopter_tours', 'is_top_destination')) {
                $table->boolean('is_top_destination')->default(false);
            }
            if (!Schema::hasColumn('helicopter_tours', 'sort_order')) {
                $table->integer('sort_order')->default(0);
            }
            if (!Schema::hasColumn('helicopter_tours', 'section_priority')) {
                $table->integer('section_priority')->default(0);
            }
        });
    }

    public function down()
    {
        Schema::table('helicopter_tours', function (Blueprint $table) {
            $table->dropColumn(['is_featured', 'is_popular', 'is_top_destination', 'sort_order', 'section_priority']);
        });
    }
};
