<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('activities', function (Blueprint $table) {
            if (!Schema::hasColumn('activities', 'is_featured')) {
                $table->boolean('is_featured')->default(false);
            }
            if (!Schema::hasColumn('activities', 'is_popular')) {
                $table->boolean('is_popular')->default(false);
            }
            if (!Schema::hasColumn('activities', 'is_top_destination')) {
                $table->boolean('is_top_destination')->default(false);
            }
            if (!Schema::hasColumn('activities', 'sort_order')) {
                $table->integer('sort_order')->default(0);
            }
            if (!Schema::hasColumn('activities', 'section_priority')) {
                $table->integer('section_priority')->default(0);
            }
        });
    }

    public function down()
    {
        Schema::table('activities', function (Blueprint $table) {
            $table->dropColumn(['is_featured', 'is_popular', 'is_top_destination', 'sort_order', 'section_priority']);
        });
    }
};
