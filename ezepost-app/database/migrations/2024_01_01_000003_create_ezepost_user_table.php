<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('ezepost_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained()->cascadeOnDelete();
            $table->string('desktop_username')->unique();
            $table->string('desktop_password_hash');
            $table->char('controllingstring', 20)->default('00000000000000000000');
            $table->decimal('topup_balance', 10, 2)->default(0);
            $table->string('stripe_customer_id')->nullable()->index();
            $table->enum('team_role', ['leader','member'])->nullable();
            $table->unsignedTinyInteger('package_limit_code')->default(0);
            $table->unsignedTinyInteger('team_size_code')->default(0);
            $table->unsignedTinyInteger('group_code')->default(0);
            $table->unsignedTinyInteger('plan_code')->default(0);
            $table->enum('desktop_account_status', ['active','locked'])->default('active');
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('ezepost_user'); }
};
