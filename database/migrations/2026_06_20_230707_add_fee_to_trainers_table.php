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
        Schema::table('trainers', function (Blueprint $table) {
            $table->integer('fee_reguler')->default(0)->after('wa_number');
            $table->integer('fee_non_reguler')->default(0)->after('fee_reguler');
            $table->integer('fee_online')->default(0)->after('fee_non_reguler');
            $table->integer('fee_privat')->default(0)->after('fee_online');
            $table->integer('user_id')->nullable()->after('agree_contract');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('trainers', function (Blueprint $table) {
            $table->dropColumn(['fee_reguler', 'fee_non_reguler', 'fee_online', 'fee_privat', 'user_id']);
        });
    }
};
