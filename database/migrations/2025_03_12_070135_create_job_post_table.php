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
        Schema::create('job_post', function (Blueprint $table) {
            $table->id();
            $table->integer('recruiter_id');
            $table->string('title');
            $table->string('type');
            $table->text('skills');
            $table->string('industry');
            $table->string('department');
            $table->string('role');
            $table->string('mode');
            $table->string('location');
            $table->string('min_exp');
            $table->string('max_exp')->nullable();
            $table->string('currency');
            $table->string('min_sal');
            $table->string('max_sal')->nullable();
            $table->string('sal_status')->default('off');
            $table->string('education_level');
            $table->string('education');
            $table->string('branch')->nullable();
            $table->string('condidate_industry')->nullable();
            $table->string('diversity')->default('All');
            $table->integer('vacancies');
            $table->string('int_type');
            $table->string('com_name');
            $table->string('com_logo');
            $table->text('com_details');
            $table->date('jobexpiry');
            $table->text('job_desc');
            $table->text('job_resp');
            $table->text('job_req');
            $table->tinyInteger('admin_verify')->default(0);
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_post');
    }
};
