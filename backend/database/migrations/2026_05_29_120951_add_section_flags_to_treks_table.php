<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('treks', function (Blueprint $table) {
            if (!Schema::hasColumn('treks', 'is_popular')) {
                $table->boolean('is_popular')->default(false);
            }
            if (!Schema::hasColumn('treks', 'is_top_destination')) {
                $table->boolean('is_top_destination')->default(false);
            }
        });
    }

    public function down(): void
    {
        Schema::table('treks', function (Blueprint $table) {
            $table->dropColumn(['is_popular', 'is_top_destination']);
        });
    }
};
