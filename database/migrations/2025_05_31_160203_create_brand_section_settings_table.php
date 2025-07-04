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
        Schema::create('brand_section_settings', function (Blueprint $table) {
            $table->id();
            $table->enum('show_section', [0, 1])->default(1);
             $table->string('title')->nullable(); // Section title
            $table->json('logos')->nullable(); // Store array of logo paths
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brand_section_settings');
    }
};
