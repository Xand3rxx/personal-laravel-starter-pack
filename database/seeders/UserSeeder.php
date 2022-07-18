<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Administrative user account
        User::create([
            'role_id'           => 1,
            'email'             => 'admin@mail.com',
            'password'          => bcrypt('password'),
            'email_verified_at' => now(),
            'name'              => 'Administrator',
        ]);

        // Create global user for easy test
        User::create([
            'role_id'           => 2,
            'email'             => 'john.doe@gmail.com',
            'password'          => bcrypt('password'),
            'email_verified_at' => now(),
            'name'              => 'J. Doe',
        ]);

        // Generate 18 other client users
        User::factory(18)->create();
    }
}
