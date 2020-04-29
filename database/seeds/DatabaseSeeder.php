<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(UsersTableSeeder::class);
        DB::table('users')->insert([
            [
                'name' => 'cat',
                'email' => 'cat@mail.com',
                'password'=>bcrypt('12345678'),
            ],
            [
                'name' => 'dog',
                'email' => 'dog@mail.com',
                'password'=>bcrypt('12345678')
            ]
        ]);

        DB::table('items')->insert([
            [
                'name' => 'cat photo',
                'content' => 'book',
                'price'=>99,
            ],
            [
                'name' => 'dog book',
                'content' => 'book',
                'price'=>10
            ]
        ]);
    }
}
