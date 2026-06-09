<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('peaks', function (Blueprint $table) {
            if (!Schema::hasColumn('peaks', 'is_popular')) {
                $table->boolean('is_popular')->default(false);
            }
            if (!Schema::hasColumn('peaks', 'is_top_destination')) {
                $table->boolean('is_top_destination')->default(false);
            }
            if (!Schema::hasColumn('peaks', 'section_priority')) {
                $table->integer('section_priority')->default(0);
            }
            if (!Schema::hasColumn('peaks', 'sort_order')) {
                $table->integer('sort_order')->default(0);
            }
        });
    }

    public function down()
    {
        Schema::table('peaks', function (Blueprint $table) {
            $table->dropColumn(['is_popular', 'is_top_destination', 'section_priority', 'sort_order']);
        });
    }
};
