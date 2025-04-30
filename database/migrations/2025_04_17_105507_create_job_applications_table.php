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
        Schema::create('job_applications', function (Blueprint $table) {
            $table->id();

            // Foreign key to users table
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // Foreign key to job_post table
            $table->unsignedBigInteger('job_id');
            $table->foreign('job_id')->references('id')->on('job_post')->onDelete('cascade');

            // Status of application
            $table->enum('status', ['pending', 'shortlisted', 'rejected', 'hired'])->default('pending');

            $table->enum('recruiter_view', [0, 1])->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_applications');
    }
};
