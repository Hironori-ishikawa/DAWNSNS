<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(
        [
            'username' => 'テストユーザー',
            'mail' => 'test@gmail.com',
            'password' => bcrypt('testtest'),
            'bio' => 'test',
            'images' => null,
            'remember_token' => Str::random(10),
        ]

    );

    }
}
