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
        Schema::create('explorers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('identification');
            $table->string('email');
            $table->text('image');
            $table->foreignId('expedition_id')->references('id')->on('expeditions');
            $table->foreignId('guide_id')->references('id')->on('guides');
            $table->foreignId('artifact_id')->references('id')->on('artifacts');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('explorers');
    }
};
