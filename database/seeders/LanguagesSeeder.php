<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Seeder;

class LanguagesSeeder extends Seeder
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
                'id' => '1',
                'iso' => 'hy',
                'title' => 'Հայերեն',
                'active' => true,
                'default' => false,
                'admin' => false,
            ],
            [
                'id' => '2',
                'iso' => 'ru',
                'title' => 'Русский',
                'active' => true,
                'default' => false,
                'admin' => false,
            ],
            [
                'id' => '3',
                'iso' => 'en',
                'title' => 'English',
                'active' => true,
                'default' => true,
                'admin' => true,
            ]
        ];

        Language::query()->insert($data);
    }
}
