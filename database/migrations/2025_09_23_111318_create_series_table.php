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
        Schema::create('series', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->index();
            $table->string('name')->index();
            $table->string('release_date');
            $table->string('image');
            $table->longText('description');
            $table->double('rating');
            $table->bigInteger('view_count');
            $table->timestamps();

        });
        Schema::create('category_series', function(Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('series_id')->index();
            $table->unsignedBigInteger('category_id')->index();
            $table->timestamps();

    });}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('series');
    }
};
