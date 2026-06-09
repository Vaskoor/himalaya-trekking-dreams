<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('trek_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trek_id')->constrained()->onDelete('cascade');
            $table->string('locale', 2);
            $table->string('name');
            $table->text('short_description');
            $table->longText('description');
            $table->text('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('og_image')->nullable();
            $table->unique(['trek_id', 'locale']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('trek_translations');
    }
};
