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
        Schema::create('trainers', function (Blueprint $table) {
            $table->id();
            // Foreign key ke users (One-to-One)

            $table->foreignId('user_id')
                  ->unique()
                  ->constrained('users')
                  ->onDelete('cascade');
                  
            $table->string('card_id',20)->nullable();
            $table->string('name',30);
            $table->string('address',100);
            $table->string('email',40);
            $table->string('wa_number',15);
            $table->enum('gender',['L','P'])->nullable();
            $table->string('place_of_birth',50);
            $table->date('date_of_birth');
            $table->date('date_of_entry');
            $table->string('ktp_number',20);
            $table->enum('is_active',['0','1'])->default('1');
            $table->string('photo',100)->nullable();
            $table->enum('agree_contract',['0','1'])->default('1');
            $table->integer('fee_reguler')->nullable();
            $table->integer('fee_non_reguler')->nullable();
            $table->integer('fee_online')->nullable();
            $table->integer('fee_privat')->nullable();
            $table->integer('user_input')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trainers');
    }
};
