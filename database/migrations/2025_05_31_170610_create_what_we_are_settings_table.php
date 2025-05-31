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
        Schema::create('what_we_are_settings', function (Blueprint $table) {
            $table->id();
            $table->enum('show_section', [0, 1])->default(1);
            $table->string('section_image')->nullable();
            $table->string('title')->nullable();     // e.g., "Why We Are Most Popular"
            $table->text('description')->nullable(); // main paragraph content
            $table->json('points')->nullable();
            $table->string('button_text')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('what_we_are_settings');
    }
};
