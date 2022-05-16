<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Symfony\Component\Console\Helper\Table;
use Illuminate\Support\Str;
use DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => "Автор не известен",
                'email' => "autor_unknown@g.g",
                'password' =>bcrypt(Str::random(16)),

            ],
            [
                'name' => "Автор",
                'email' => "autor1@g.g",
                'password' => bcrypt(123456),

            ],
        ];
        DB::Table("users")->insert($data);
    }
}
