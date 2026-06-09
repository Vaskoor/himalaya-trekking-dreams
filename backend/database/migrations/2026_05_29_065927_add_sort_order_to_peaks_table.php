<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('peaks', function (Blueprint $table) {
            if (!Schema::hasColumn('peaks', 'sort_order')) {
                $table->integer('sort_order')->default(0);
            }
            if (!Schema::hasColumn('peaks', 'is_featured')) {
                $table->boolean('is_featured')->default(false);
            }
        });
    }

    public function down(): void
    {
        Schema::table('peaks', function (Blueprint $table) {
            $table->dropColumn(['sort_order', 'is_featured']);
        });
    }
};
