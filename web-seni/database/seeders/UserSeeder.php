<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
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
                'nama' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('admin123'),
                'ttl' => 'Tegal, 17-06-1999',
                'agama' => 'Islam',
                'alamat' => 'tegal',
                'no_hp' => '0822371881292',
                'foto' => '--',
                'role_id' => '1',
                'emailverification' => '1',

            ],
        ];

        \DB::table('users')->insert($posts);
    }
}
