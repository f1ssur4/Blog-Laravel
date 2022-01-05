<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReviewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            DB::table('reviews')->insert([
                'username' => 'user' . $i,
                'email' => 'user' . $i . '@gmail.com',
                'content' => 'Review ' . $i,
                'status' => '1',
                'date_create' => date('Y:m:d'),
            ]);
        }
    }
}
