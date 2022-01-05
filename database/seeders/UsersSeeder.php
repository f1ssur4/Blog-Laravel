<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            DB::table('users')->insert([
                'username' => 'user' . $i,
                'email' => 'user' . $i .'@gmail.com',
                'password_hash' => Hash::make('password'),
                'role_id' => '1',
            ]);
        }
    }
}
