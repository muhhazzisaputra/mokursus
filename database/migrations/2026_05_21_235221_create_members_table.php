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
        Schema::create('members', function (Blueprint $table) {
            $table->id();

            // Foreign key ke users (One-to-One)
            $table->foreignId('user_id')
                  ->unique()
                  ->constrained('users')
                  ->onDelete('cascade');

            $table->string('member_code',13);
            $table->string('full_name');
            $table->string('place_of_birth');
            $table->date('date_of_birth');
            $table->string('full_address');
            $table->string('wa_number');
            $table->string('image');
            $table->enum('is_active',['0','1'])->default('1');
            $table->enum('alumni_status',['0','1'])->default('0');
            $table->string('course_id')->nullable();
            $table->string('last_education', 25)->nullable();
            $table->string('nik', 100)->nullable();
            $table->string('certificate_number', 100)->nullable();
            $table->integer('user_input')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
