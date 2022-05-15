<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::create([
            'first_name' => 'youssef',
            'last_name' => 'youssef',
            'username' => 'youssef',
            'email' => 'youssef@example.com',
            'password' => bcrypt('youssef'),
        ]);
    }
}
