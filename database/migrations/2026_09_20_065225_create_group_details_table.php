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
        Schema::create('group_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('group_id')->constrained('course_groups')->onDelete('cascade');
            $table->foreignId('course_member_id')->constrained('course_members')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('group_details');
    }
};
