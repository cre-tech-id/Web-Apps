<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = [
            [
                'id' => 1,
                'role' => 'admin',
            ],
            [
                'id' => 2,
                'role' => 'penyedia',
            ],
            [
                'id' => 3,
                'role' => 'user',
            ],
        ];

        \DB::table('role')->insert($posts);
    }
}
