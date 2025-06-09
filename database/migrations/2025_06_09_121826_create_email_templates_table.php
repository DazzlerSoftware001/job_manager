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
            $table->string('name')->unique(); // e.g. 'user_hired', 'user_rejected'
            $table->string('slug'); // e.g. 'user_hired', 'user_rejected'
            $table->string('subject');
            $table->longText('body');
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
