<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlanPeriodSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('periods')->insert([
            ['name' => 'monthly', 'months_count' => 1, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'yearly', 'months_count' => 12, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
        ]);

        DB::table('plans')->insert([
            ['name' => 'Starter', 'currency' => 'GBP', 'package_size_code' => 1, 'team_size_code' => 0, 'user_group_code' => 0, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Basic', 'currency' => 'GBP', 'package_size_code' => 3, 'team_size_code' => 1, 'user_group_code' => 1, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Premium', 'currency' => 'GBP', 'package_size_code' => 9, 'team_size_code' => 2, 'user_group_code' => 1, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
