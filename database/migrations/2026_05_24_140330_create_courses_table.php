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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('course_code',10)->nullable();
            $table->string('name');
            $table->string('image')->nullable();
            $table->integer('price');
            $table->integer('discount');
            $table->integer('tax');
            $table->integer('offline_price');
            $table->integer('offline_discount');
            $table->integer('offline_tax');
            $table->integer('non_regular_price');
            $table->integer('non_regular_discount');
            $table->integer('non_regular_tax');
            $table->integer('private_price');
            $table->integer('private_discount');
            $table->integer('private_tax');
            $table->enum('is_active',['0','1'])->default('1');
            $table->string('for_class',30)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
