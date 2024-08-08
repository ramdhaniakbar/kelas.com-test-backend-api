<?php

namespace Database\Seeders;

use App\Models\Mentor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MentorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Mentor::insert([
            [
                'name' => 'Ramdhani Akbar',
                'email' => 'ramdhani.akbar@example.com',
                'revenue' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Fatimah Azzahra',
                'email' => 'fatimah.azzahra@example.com',
                'revenue' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Asep Saepulloh',
                'email' => 'asep.saepulloh@example.com',
                'revenue' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
