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
        Schema::create('general_setting', function (Blueprint $table) {
            $table->id();
            $table->string('site_title')->nullable();
            $table->string('logo')->nullable();
            $table->string('light_logo')->nullable();
            // $table->string('dark_logo')->nullable();
            $table->string('favicon')->nullable();
            $table->string('timezone')->default('Asia/Kolkata');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('general_setting');
    }
};
