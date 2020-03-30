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

        // сначала сгенерим авторов
        $this->call(AuthorSeeder::class);

        // затем сгенерим их посты
        for ($i = 0; $i < 20; $i++){
            $this->call(PostSeeder::class);
        }
    }
}
