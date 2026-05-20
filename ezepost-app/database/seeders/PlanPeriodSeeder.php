<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlanPeriodSeeder extends Seeder
{
    public function run(): void
    {
        // Seed periods
        DB::table('periods')->insert([
            ['name' => 'monthly', 'months_count' => 1, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'yearly', 'months_count' => 12, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Seed plans - matching SQL data
        $features = json_encode([
            "Max Size 50MB",
            "Single File Send",
            "Normal Delivery",
            "Register Delivery(extra charge)",
            "Special Delivery(extra charge)"
        ]);

        DB::table('plans')->insert([
            // Personal Plans
            [
                'type' => 'Personal',
                'name' => 'Personal Starter',
                'code' => 'PAG-00000',
                'price' => 10.99,
                'icon' => '/icon-arcade.svg',
                'slug' => 'pay-as-you-go',
                'stripe_plan' => '',
                'description' => 'Best option for personal use & for your next project.',
                'message' => 'Best option for personal use & for your next project.',
                'options' => $features,
                'currency' => 'GBP',
                'package_size_code' => 0,
                'team_size_code' => 0,
                'user_group_code' => 0,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'type' => 'Personal',
                'name' => 'Personal Premium',
                'code' => 'PMB-00001',
                'price' => 12.99,
                'icon' => '/icon-arcade.svg',
                'slug' => 'personal-premium',
                'stripe_plan' => '',
                'description' => 'Best option for personal use & for your next project.',
                'message' => 'Best option for personal use & for your next project.',
                'options' => $features,
                'currency' => 'GBP',
                'package_size_code' => 1,
                'team_size_code' => 0,
                'user_group_code' => 0,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'type' => 'Personal',
                'name' => 'Personal Premium Plus',
                'code' => 'PMP-00002',
                'price' => 15.99,
                'icon' => '/icon-arcade.svg',
                'slug' => 'personal-premium-plus',
                'stripe_plan' => '',
                'description' => 'Best option for personal use & for your next project.',
                'message' => 'Best option for personal use & for your next project.',
                'options' => $features,
                'currency' => 'GBP',
                'package_size_code' => 2,
                'team_size_code' => 0,
                'user_group_code' => 0,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            // Business Plans
            [
                'type' => 'Business',
                'name' => 'Business Starter',
                'code' => 'BAG-00003',
                'price' => 15.99,
                'icon' => '/icon-arcade.svg',
                'slug' => 'business-starter',
                'stripe_plan' => '',
                'description' => 'Best option for personal use & for your next project.',
                'message' => 'Best option for personal use & for your next project.',
                'options' => $features,
                'currency' => 'GBP',
                'package_size_code' => 0,
                'team_size_code' => 0,
                'user_group_code' => 1,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'type' => 'Business',
                'name' => 'Business Premium',
                'code' => 'BMB-00004',
                'price' => 20.99,
                'icon' => '/icon-arcade.svg',
                'slug' => 'business-premium',
                'stripe_plan' => '',
                'description' => 'Best option for personal use & for your next project.',
                'message' => 'Best option for personal use & for your next project.',
                'options' => $features,
                'currency' => 'GBP',
                'package_size_code' => 1,
                'team_size_code' => 1,
                'user_group_code' => 1,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'type' => 'Business',
                'name' => 'Business Premium Plus',
                'code' => 'BMP-00005',
                'price' => 25.99,
                'icon' => '/icon-arcade.svg',
                'slug' => 'business-premium-plus',
                'stripe_plan' => '',
                'description' => 'Best option for personal use & for your next project.',
                'message' => 'Best option for personal use & for your next project.',
                'options' => $features,
                'currency' => 'GBP',
                'package_size_code' => 2,
                'team_size_code' => 2,
                'user_group_code' => 1,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
