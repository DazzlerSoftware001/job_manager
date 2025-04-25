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
        Schema::create('education_qualifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('level'); // 10th, 12th, Graduation, etc.
            $table->string('board_university');
            $table->string('school_college');
            $table->string('stream')->nullable();
            $table->string('passing_year');
            $table->string('percentage');
            $table->timestamps();

             // Optional foreign key constraint
             $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
             
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('education_qualifications');
    }
};
