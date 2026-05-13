<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('ezepost_tracking', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sender_ezepost_user_id')->constrained('ezepost_user');
            $table->foreignId('receiver_ezepost_user_id')->constrained('ezepost_user');
            $table->string('transfer_reference')->unique();
            $table->enum('direction', ['sent','received']);
            $table->unsignedTinyInteger('file_count')->default(1);
            $table->json('file_names')->nullable();
            $table->unsignedBigInteger('package_size')->default(0);
            $table->enum('status', ['sent','received','viewed','failed'])->default('sent');
            $table->timestamp('transferred_at')->nullable();
            $table->timestamp('viewed_at')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('ezepost_tracking'); }
};
