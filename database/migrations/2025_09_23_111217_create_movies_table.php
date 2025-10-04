<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->index();
            $table->string('release_date');
            $table->string('name')->index();
            $table->string('image');
            $table->longText('description');
            $table->string('embed_link');
            $table->double('rating');
            $table->bigInteger('view_count');
            $table->timestamps();
        });

        Schema::create('category_movie', function(Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('movie_id')->index();
            $table->unsignedBigInteger('category_id')->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
