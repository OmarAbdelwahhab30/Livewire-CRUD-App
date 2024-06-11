<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::factory(100)->create([
            'name' => 'Test User',
            'email' => fake("en")->unique()->name("male").rand(10,10000).rand(120,600)."@".fake()->name.rand(10,100).".com",
        ]);
    }
}
