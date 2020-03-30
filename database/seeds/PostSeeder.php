<?php

use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $randomWords = json_decode(
            file_get_contents('https://random-word-api.herokuapp.com/word?number=2')
        );

        $curTime = now(); // получаем время создания/изменения поста
        DB::table('posts')->insert([
            'title' => 'Пост про '.$randomWords[0].' и '.$randomWords[1],  //Str::random(7),
            'text' => str_repeat('Lorem Ipsum ', random_int(1,10)),
            'author_id' => DB::table('authors')->get('id')->random()->id,
            'created_at' => $curTime,
            'updated_at' => $curTime,
        ]);
    }
}
