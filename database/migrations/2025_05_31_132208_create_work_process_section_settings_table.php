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
        Schema::create('work_process_section_settings', function (Blueprint $table) {
            $table->id();
            $table->enum('show_section', [0, 1])->default(1);
            $table->string('work_title')->nullable();
            $table->string('work_message')->nullable();
            $table->json('cards')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('work_process_section_settings');
    }
};
