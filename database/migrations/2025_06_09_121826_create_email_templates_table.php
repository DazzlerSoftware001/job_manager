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
        Schema::create('email_templates', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('user_type')->default(0)->comment('0 = User, 1 = Admin, 2 = Recruiter');
            $table->tinyInteger('send_to')->default(0)->comment('0 = User, 1 = Admin, 2 = Recruiter');
            $table->string('name')->unique()->nullable(); // e.g. 'user_hired', 'user_rejected'
            $table->enum('show_email', [0, 1])->default(0);
            $table->string('subject')->nullable();
            $table->longText('body')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('email_templates');
    }
};
