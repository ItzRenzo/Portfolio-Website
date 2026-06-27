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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');
            $table->string('category')->nullable(); // e.g., 'Survival', 'Minigame', 'Lobby', etc.
            $table->string('image_url')->nullable();
            $table->string('external_url')->nullable();
            $table->json('tags')->nullable(); // Array of tags
            $table->boolean('featured')->default(false);
            $table->integer('display_order')->default(0);
            $table->string('emoji')->nullable(); // Icon emoji for the card
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
