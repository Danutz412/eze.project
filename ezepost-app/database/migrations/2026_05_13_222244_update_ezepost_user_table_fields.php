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
            // Rename fields to match SQL schema
            $table->renameColumn('desktop_username', 'username');
            $table->renameColumn('desktop_password_hash', 'password');
            $table->renameColumn('controllingstring', 'controlstring');
            $table->renameColumn('topup_balance', 'balance');
            $table->renameColumn('desktop_account_status', 'status');
            
            // Add new fields
            $table->string('vepost_addr')->after('username');
            $table->string('vepost_counter')->default('10')->after('balance');
            $table->string('free_send_left')->nullable()->after('status');
            
            // Remove fields that don't exist in SQL schema
            $table->dropColumn([
                'stripe_customer_id',
                'team_role',
                'package_limit_code',
                'team_size_code',
                'group_code',
                'plan_code'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ezepost_user', function (Blueprint $table) {
            // Reverse the renames
            $table->renameColumn('username', 'desktop_username');
            $table->renameColumn('password', 'desktop_password_hash');
            $table->renameColumn('controlstring', 'controllingstring');
            $table->renameColumn('balance', 'topup_balance');
            $table->renameColumn('status', 'desktop_account_status');
            
            // Drop new fields
            $table->dropColumn(['vepost_addr', 'vepost_counter', 'free_send_left']);
            
            // Add back removed fields
            $table->string('stripe_customer_id')->nullable();
            $table->string('team_role')->nullable();
            $table->string('package_limit_code')->nullable();
            $table->string('team_size_code')->nullable();
            $table->string('group_code')->nullable();
            $table->string('plan_code')->nullable();
        });
    }
};
