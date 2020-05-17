<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Used to seed the users table
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Jeffrey',
            'email' => 'jeffrey@qoutes.com',
            'password' =>  Hash::make('password'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
