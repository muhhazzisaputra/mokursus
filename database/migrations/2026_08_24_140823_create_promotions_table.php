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
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onDelete('cascade');

            $table->string('promo_code',50);
            $table->string('name',50);
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('promo_type', ['Nominal', 'Percent'])->nullable();
            $table->integer('promo_value');
            $table->char('promo_status',1);
            $table->date('approval_date')->nullable();
            $table->string('promo_code_hash',70)->nullable();
            $table->integer('user_input')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promotions');
    }
};
