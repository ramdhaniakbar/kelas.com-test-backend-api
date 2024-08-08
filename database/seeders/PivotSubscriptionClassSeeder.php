<?php

namespace Database\Seeders;

use App\Models\PivotSubscriptionClass;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PivotSubscriptionClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PivotSubscriptionClass::insert([
            [
                'subscription_id' => 1,
                'class_model_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'subscription_id' => 2,
                'class_model_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'subscription_id' => 2,
                'class_model_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'subscription_id' => 3,
                'class_model_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'subscription_id' => 3,
                'class_model_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'subscription_id' => 3,
                'class_model_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
