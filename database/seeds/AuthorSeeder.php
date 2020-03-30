<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuthorSeeder extends Seeder
{
    // Авторы для тестов
    private $names = [
        'Александр Пушкин',
        'Федор Тютчев',
        'Лев Толстой',
        'Михаил Лермонтов',
        'Сергей Есенин'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->names as $name) {
            DB::table('authors')->insert(['name' => $name]);
        }
    }
}
