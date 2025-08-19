<?php

namespace Database\Seeders;

use App\Models\User;
// use App\Models\ClassModel; // Update this line if your model is named 'ClassModel'
use App\Models\SchoolClass; // Update this line if your model is named 'SchoolClass'
use App\Models\Section; // Import the Section model
use App\Models\Subject; // Import the Subject model
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

$this->call([
    UserSeeder::class,
    // আপনি আরও সেডার ফাইল তৈরি করলে এখানে যুক্ত করবেন। যেমন:
    // ClassSeeder::class,
    // SubjectSeeder::class,
]);
SchoolClass::factory(5)->create()->each(function ($class) {
    $class->sections()->saveMany(Section::factory(3)->make());
});

Subject::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
            'email_verified_at' => now(),
            'remember_token' => \Illuminate\Support\Str::random(10),
        ])->assignRole('admin');
        User::factory()->create([
            'name' => 'Teacher User',
            'email' => 'teacher@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'teacher',
            'email_verified_at' => now(),
            'remember_token' => \Illuminate\Support\Str::random(10),
        ])->assignRole('teacher');
    }
}
