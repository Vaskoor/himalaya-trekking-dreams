<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('treks', function (Blueprint $table) {
            $table->json('name')->nullable();
            $table->json('short_description')->nullable();
            $table->json('description')->nullable();
            $table->json('meta_title')->nullable();
            $table->json('meta_description')->nullable();
            $table->json('og_image')->nullable();
        });
    }

    public function down()
    {
        Schema::table('treks', function (Blueprint $table) {
            $table->dropColumn([
                'name', 'short_description', 'description',
                'meta_title', 'meta_description', 'og_image'
            ]);
        });
    }
};