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
        Schema::create('works', function (Blueprint $table) {
            $table->id();

            $table->foreignId('member_id')
                  ->constrained('members')
                  ->onDelete('cascade');

            $table->string('title',50);
            $table->string('description',150);
            $table->string('technology_used',50);
            $table->integer('price')->nullable();
            $table->integer('promotional_price')->nullable();
            $table->string('link',100)->nullable();
            $table->string('image',100)->nullable();
            $table->integer('user_input')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('works');
    }
};
