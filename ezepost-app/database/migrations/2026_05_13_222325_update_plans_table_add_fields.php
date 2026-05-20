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
        Schema::table('plans', function (Blueprint $table) {
            // Add new fields to match SQL schema
            $table->string('type')->nullable()->after('id'); // Personal or Business
            $table->string('code')->nullable()->after('name'); // PAG-00000, PMB-00001, etc.
            $table->decimal('price', 8, 2)->nullable()->after('plan_type'); // Price field
            $table->string('icon')->nullable()->after('price'); // Icon path
            $table->string('slug')->nullable()->after('icon'); // URL slug
            $table->string('stripe_plan')->nullable()->after('slug'); // Stripe plan ID
            $table->string('description')->nullable()->after('stripe_plan');
            $table->string('message')->nullable()->after('description');
            $table->json('options')->nullable()->after('message'); // Features array
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('plans', function (Blueprint $table) {
            $table->dropColumn([
                'type',
                'code',
                'price',
                'icon',
                'slug',
                'stripe_plan',
                'description',
                'message',
                'options'
            ]);
        });
    }
};
