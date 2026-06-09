<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up() {
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('author_name');
            $table->string('author_country')->nullable();
            $table->string('platform')->nullable();
            $table->integer('rating')->unsigned()->default(5);
            $table->string('title');
            $table->text('comment');
            $table->string('trek_name')->nullable();
            $table->date('date')->nullable();
            $table->boolean('is_approved')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }
    public function down() { Schema::dropIfExists('testimonials'); }
};
