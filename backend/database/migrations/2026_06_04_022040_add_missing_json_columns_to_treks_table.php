<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('treks', function (Blueprint $table) {
            if (!Schema::hasColumn('treks', 'tagline')) {
                $table->json('tagline')->nullable();
            }
            if (!Schema::hasColumn('treks', 'highlights')) {
                $table->json('highlights')->nullable();
            }
            if (!Schema::hasColumn('treks', 'places')) {
                $table->json('places')->nullable();
            }
            if (!Schema::hasColumn('treks', 'included')) {
                $table->json('included')->nullable();
            }
            if (!Schema::hasColumn('treks', 'excluded')) {
                $table->json('excluded')->nullable();
            }
            if (!Schema::hasColumn('treks', 'itinerary')) {
                $table->json('itinerary')->nullable();
            }
            if (!Schema::hasColumn('treks', 'start_end')) {
                $table->string('start_end')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('treks', function (Blueprint $table) {
            $table->dropColumn([
                'tagline', 'highlights', 'places', 'included',
                'excluded', 'itinerary', 'start_end'
            ]);
        });
    }
};