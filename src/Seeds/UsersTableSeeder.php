<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
                'id' => 1,
                'name' => 'Blogfolio',
                'email' => 'mail@ukadev.com',
                'password' => Hash::make('password')
            ]
        );
    }
}
