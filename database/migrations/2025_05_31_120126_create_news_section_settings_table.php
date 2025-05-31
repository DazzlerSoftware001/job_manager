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
        Schema::create('news_section_settings', function (Blueprint $table) {
            $table->id();
            $table->string('news_title')->nullable();
            $table->string('news_message')->nullable();
            $table->json('cards')->nullable(); // cards data stored as JSON
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news_section_settings');
    }
};
