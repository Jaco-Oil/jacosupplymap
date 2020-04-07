<?php

use Illuminate\Database\Seeder;
use App\User;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'        => 'Admin',
            'email'             => 'admin@test.com',
            'password'          => bcrypt('admin'),
            'role' => '1'
        ]);

        User::create([
            'name'        => 'Victor',
            'email'             => 'victor.lototskyy@gmail.com',
            'password'          => bcrypt('qwerty'),
            'role' => '1'
        ]);

        User::create([
            'name'        => 'Phil',
            'email'             => 'PhilB@jaco.com',
            'password'          => bcrypt('qwerty'),
            'role' => '1'
        ]);
    }
}
