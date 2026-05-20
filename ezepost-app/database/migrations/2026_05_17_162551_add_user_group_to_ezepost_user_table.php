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
        Schema::table('ezepost_user', function (Blueprint $table) {
            $table->tinyInteger('user_group')->default(0)->after('user_id')->comment('0=Personal, 1=Business');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ezepost_user', function (Blueprint $table) {
            $table->dropColumn('user_group');
        });
    }
};
