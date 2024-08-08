<?php

namespace Database\Seeders;

use App\Models\ClassModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ClassModel::insert([
            [
                'mentor_id' => 1,
                'name' => 'Introduction to Programming',
                'duration' => 20,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'mentor_id' => 2,
                'name' => 'Advanced JavaScript',
                'duration' => 50, // Duration in minutes
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'mentor_id' => 2,
                'name' => 'Data Structures and Algorithms',
                'duration' => 30, // Duration in minutes
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
