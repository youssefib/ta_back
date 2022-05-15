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
            'last_name' => 'ibaichou',
            'username' => 'ucef',
            'email' => 'youssef@app.com',
            'password' => bcrypt('youssef'),
        ]);

        \App\Models\User::create([
            'first_name' => 'f_user1',
            'last_name' => 'l_user1',
            'username' => 'u_user1',
            'email' => 'e_user1@app.com',
            'password' => bcrypt('user1'),
        ]);

        \App\Models\User::create([
            'first_name' => 'f_user2',
            'last_name' => 'l_user2',
            'username' => 'u_user2',
            'email' => 'e_user2@app.com',
            'password' => bcrypt('user2'),
        ]);

        \App\Models\User::create([
            'first_name' => 'f_user3',
            'last_name' => 'l_user3',
            'username' => 'u_user3',
            'email' => 'e_user3@app.com',
            'password' => bcrypt('user3'),
        ]);

        \App\Models\User::create([
            'first_name' => 'f_user4',
            'last_name' => 'l_user4',
            'username' => 'u_user4',
            'email' => 'e_user4@app.com',
            'password' => bcrypt('user4'),
        ]);

        \App\Models\User::create([
            'first_name' => 'f_user5',
            'last_name' => 'l_user5',
            'username' => 'u_user5',
            'email' => 'e_user5@app.com',
            'password' => bcrypt('user5'),
        ]);
    }
}
