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
        Schema::table('ezepost_tracking', function (Blueprint $table) {
            $table->foreignId('sender_user_id')->nullable()->constrained('users')->after('id');
            $table->foreignId('receiver_user_id')->nullable()->constrained('users')->after('sender_user_id');
            $table->string('file_name')->nullable()->after('file_names');
            $table->string('file_path')->nullable()->after('file_name');
            $table->unsignedBigInteger('file_size')->nullable()->after('file_path');
            $table->text('message')->nullable()->after('file_size');
            $table->string('controlstring')->nullable()->after('message');
            $table->boolean('is_viewed')->default(false)->after('status');
            $table->boolean('notify_recipient')->default(true)->after('is_viewed');
            $table->boolean('require_password')->default(false)->after('notify_recipient');
            $table->boolean('track_download')->default(true)->after('require_password');
            $table->timestamp('expires_at')->nullable()->after('viewed_at');
            $table->timestamp('received_at')->nullable()->after('expires_at');
            $table->timestamp('opened_at')->nullable()->after('received_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ezepost_tracking', function (Blueprint $table) {
            $table->dropForeign(['sender_user_id']);
            $table->dropForeign(['receiver_user_id']);
            $table->dropColumn([
                'sender_user_id',
                'receiver_user_id',
                'file_name',
                'file_path',
                'file_size',
                'message',
                'controlstring',
                'is_viewed',
                'notify_recipient',
                'require_password',
                'track_download',
                'expires_at',
                'received_at',
                'opened_at'
            ]);
        });
    }
};
