<?php

namespace Database\Seeders;

use App\Models\Subscription;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Subscription::insert([
            [
                'name' => 'Starter',
                'description' => 'Access to basic content with limited features.',
                'price' => 59000,
                'start_date' => '2024-08-01',
                'end_date' => '2024-08-31',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Basic',
                'description' => 'Full access to all content and premium features.',
                'price' => 159000,
                'start_date' => '2024-08-01',
                'end_date' => '2024-08-31',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pro',
                'description' => 'Year-long access to all content with exclusive benefits.',
                'price' => 459000,
                'start_date' => '2024-01-01',
                'end_date' => '2024-12-31',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
