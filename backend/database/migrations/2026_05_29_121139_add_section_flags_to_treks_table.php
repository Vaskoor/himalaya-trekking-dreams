<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('treks', function (Blueprint $table) {
            if (!Schema::hasColumn('treks', 'is_popular')) {
                $table->boolean('is_popular')->default(false)->after('is_featured');
            }
            if (!Schema::hasColumn('treks', 'is_top_destination')) {
                $table->boolean('is_top_destination')->default(false)->after('is_popular');
            }
            if (!Schema::hasColumn('treks', 'section_priority')) {
                $table->integer('section_priority')->default(0)->after('sort_order');
            }
        });
    }

    public function down()
    {
        Schema::table('treks', function (Blueprint $table) {
            $table->dropColumn(['is_popular', 'is_top_destination', 'section_priority']);
        });
    }
};
