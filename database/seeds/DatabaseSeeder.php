<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username' => 'user 1',
            'email' => str_random(10).'@gmail.com',
            'password' => bcrypt('secret'),
            'sex' => 'male',
            'birthdate' => \Carbon\Carbon::now()->addYear(-20)
        ]);
        DB::table('users')->insert([
            'username' => 'user 2',
            'email' => str_random(10).'@gmail.com',
            'password' => bcrypt('secret'),
            'sex' => 'female',
            'birthdate' => \Carbon\Carbon::now()->addYear(-20)
        ]);
        DB::table('message')->insert(['user_id' => 1, 'message' => str_random(10), 'image' => 'noimages.jpg']);
        DB::table('message')->insert(['user_id' => 2, 'message' => str_random(10), 'image' => 'noimages.jpg']);
        DB::table('message')->insert(['user_id' => 1, 'message' => str_random(10), 'image' => 'noimages.jpg']);
        DB::table('message')->insert(['user_id' => 1, 'message' => str_random(10), 'image' => 'noimages.jpg']);
        DB::table('message')->insert(['user_id' => 1, 'message' => str_random(10), 'image' => 'noimages.jpg']);
        DB::table('message')->insert(['user_id' => 2, 'message' => str_random(10), 'image' => 'noimages.jpg']);
        DB::table('message')->insert(['user_id' => 1, 'message' => str_random(10), 'image' => 'noimages.jpg']);
        DB::table('message')->insert(['user_id' => 2, 'message' => str_random(10), 'image' => 'noimages.jpg']);
        DB::table('message')->insert(['user_id' => 1, 'message' => str_random(10), 'image' => 'noimages.jpg']);
        DB::table('message')->insert(['user_id' => 1, 'message' => str_random(10), 'image' => 'noimages.jpg']);
        DB::table('message')->insert(['user_id' => 1, 'message' => str_random(10), 'image' => 'noimages.jpg']);
        DB::table('message')->insert(['user_id' => 2, 'message' => str_random(10), 'image' => 'noimages.jpg']);
        DB::table('message')->insert(['user_id' => 1, 'message' => str_random(10), 'image' => 'noimages.jpg']);
        DB::table('message')->insert(['user_id' => 1, 'message' => str_random(10), 'image' => 'noimages.jpg']);
        DB::table('message')->insert(['user_id' => 1, 'message' => str_random(10), 'image' => 'noimages.jpg']);
        DB::table('message')->insert(['user_id' => 2, 'message' => str_random(10), 'image' => 'noimages.jpg']);
        DB::table('message')->insert(['user_id' => 1, 'message' => str_random(10), 'image' => 'noimages.jpg']);
        DB::table('message')->insert(['user_id' => 1, 'message' => str_random(10), 'image' => 'noimages.jpg']);
        DB::table('message')->insert(['user_id' => 2, 'message' => str_random(10), 'image' => 'noimages.jpg']);
        DB::table('message')->insert(['user_id' => 1, 'message' => str_random(10), 'image' => 'noimages.jpg']);
        DB::table('message')->insert(['user_id' => 2, 'message' => str_random(10), 'image' => 'noimages.jpg']);
        DB::table('message')->insert(['user_id' => 1, 'message' => str_random(10), 'image' => 'noimages.jpg']);
        DB::table('message')->insert(['user_id' => 2, 'message' => str_random(10), 'image' => 'noimages.jpg']);
        DB::table('message')->insert(['user_id' => 1, 'message' => str_random(10), 'image' => 'noimages.jpg']);
        DB::table('message')->insert(['user_id' => 2, 'message' => str_random(10), 'image' => 'noimages.jpg']);
        DB::table('message')->insert(['user_id' => 1, 'message' => str_random(10), 'image' => 'noimages.jpg']);
        DB::table('message')->insert(['user_id' => 2, 'message' => str_random(10), 'image' => 'noimages.jpg']);
        DB::table('message')->insert(['user_id' => 1, 'message' => str_random(10), 'image' => 'noimages.jpg', 'hasResponse' => 1]);
        DB::table('message')->insert(['user_id' => 2, 'message' => str_random(10), 'image' => 'noimages.jpg', 'hasResponse' => 1]);
        DB::table('message')->insert(['user_id' => 1, 'message' => str_random(10), 'image' => 'noimages.jpg', 'hasResponse' => 1]);
        DB::table('message')->insert(['user_id' => 1, 'message' => str_random(10), 'image' => 'noimages.jpg', 'hasResponse' => 1, 'parent_id' => 30]);
        DB::table('message')->insert(['user_id' => 2, 'message' => str_random(10), 'image' => 'noimages.jpg', 'parent_id' => 29]);
        DB::table('message')->insert(['user_id' => 1, 'message' => str_random(10), 'image' => 'noimages.jpg', 'parent_id' => 30]);
        DB::table('message')->insert(['user_id' => 1, 'message' => str_random(10), 'image' => 'noimages.jpg', 'parent_id' => 31]);
    }
}
