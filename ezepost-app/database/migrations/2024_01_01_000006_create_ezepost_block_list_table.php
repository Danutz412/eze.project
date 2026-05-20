<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('ezepost_block_list', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ezepost_user_id')->constrained('ezepost_user')->cascadeOnDelete();
            $table->foreignId('blocked_by_admin_id')->nullable()->constrained('users')->nullOnDelete();
            $table->text('reason')->nullable();
            $table->boolean('is_blocked')->default(true);
            $table->timestamp('blocked_at')->nullable();
            $table->timestamp('unblocked_at')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('ezepost_block_list'); }
};
