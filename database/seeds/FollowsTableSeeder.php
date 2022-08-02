<?php

use Illuminate\Database\Seeder;

class FollowsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $params = [
            [
                'follow' => 1,
                'follower' => 2,
            ],
            [
                'follow' => 1,
                'follower' => 3,
            ],
            [
                'follow' => 3,
                'follower' => 1,
            ],
            [
                'follow' => 4,
                'follower' => 5,
            ],
            [
                'follow' => 2,
                'follower' => 3,
            ],
            [
                'follow' => 1,
                'follower' => 5,
            ],
            [
                'follow' => 5,
                'follower' => 1,
            ],
            [
                'follow' => 2,
                'follower' => 1,
            ],
            [
                'follow' => 4,
                'follower' => 1,
            ],
            [
                'follow' => 5,
                'follower' => 1,
            ],
        ];

        foreach ($params as $param) {
            $param['created_at'] = now();
            DB::table('follows')->insert($param);
        }
    }
}
