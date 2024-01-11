<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ColorFiltersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('color_filters')->delete();

        \DB::table('color_filters')->insert(array (
            0 =>
            array (
                'id' => 4,
                'name' => '{"hy":"Կանաչ","ru":"Зеленый","en":"Green"}',
                'hex_color' => '2bff00',
                'ordering' => 0,
                'created_at' => '2020-11-18 14:48:51',
                'updated_at' => '2020-11-18 14:48:51',
            ),
            1 =>
            array (
                'id' => 5,
                'name' => '{"hy":"Սև","ru":"Черный","en":"Black"}',
                'hex_color' => '000000',
                'ordering' => 0,
                'created_at' => '2020-11-18 15:45:02',
                'updated_at' => '2020-11-18 15:45:02',
            ),
            2 =>
            array (
                'id' => 6,
                'name' => '{"hy":"Սպիտակ","ru":"Белый","en":"White"}',
                'hex_color' => 'ffffff',
                'ordering' => 0,
                'created_at' => '2020-11-18 15:46:23',
                'updated_at' => '2020-11-18 15:46:23',
            ),
            3 =>
            array (
                'id' => 7,
                'name' => '{"hy":"Կարմիր","ru":"Красный","en":"Red"}',
                'hex_color' => 'ff0000',
                'ordering' => 0,
                'created_at' => '2020-11-18 15:47:43',
                'updated_at' => '2020-11-18 15:47:43',
            ),
            4 =>
            array (
                'id' => 8,
                'name' => '{"hy":"Նարջագույն","ru":"Оранжевый","en":"Orange"}',
                'hex_color' => 'ffa600',
                'ordering' => 0,
                'created_at' => '2020-11-18 15:52:47',
                'updated_at' => '2020-11-18 15:52:47',
            ),
            5 =>
            array (
                'id' => 9,
                'name' => '{"hy":"Ոսկեգույն","ru":"Золотистый","en":"Gold"}',
                'hex_color' => 'ffd900',
                'ordering' => 0,
                'created_at' => '2020-11-18 15:54:15',
                'updated_at' => '2020-11-18 15:54:15',
            ),
            6 =>
            array (
                'id' => 10,
                'name' => '{"hy":"Դեղին","ru":"Желтый","en":"Yellow"}',
                'hex_color' => 'ffff00',
                'ordering' => 0,
                'created_at' => '2020-11-18 15:54:57',
                'updated_at' => '2020-11-18 15:54:57',
            ),
            7 =>
            array (
                'id' => 11,
                'name' => '{"hy":"Կապույտ","ru":"Синий","en":"Blue"}',
                'hex_color' => '0000ff',
                'ordering' => 0,
                'created_at' => '2020-11-18 15:56:24',
                'updated_at' => '2020-11-18 15:56:24',
            ),
            8 =>
            array (
                'id' => 12,
                'name' => '{"hy":"Մուգ կապույտ","ru":"Темно-синий","en":"Dark Blue"}',
                'hex_color' => '00008b',
                'ordering' => 0,
                'created_at' => '2020-11-18 15:57:20',
                'updated_at' => '2020-11-18 15:57:20',
            ),
            9 =>
            array (
                'id' => 13,
                'name' => '{"hy":"Շագանակագույն","ru":"Коричневый","en":"Brown"}',
                'hex_color' => '8b4513',
                'ordering' => 0,
                'created_at' => '2020-11-18 15:58:59',
                'updated_at' => '2020-11-18 15:58:59',
            ),
            10 =>
            array (
                'id' => 14,
                'name' => '{"hy":"Արծաթագույն","ru":"Серебристый","en":"Silver"}',
                'hex_color' => 'c0c0c0',
                'ordering' => 0,
                'created_at' => '2020-11-18 16:02:11',
                'updated_at' => '2020-11-18 16:02:11',
            ),
            11 =>
            array (
                'id' => 15,
                'name' => '{"hy":"Մոխրագույն","ru":"Серый","en":"Gray"}',
                'hex_color' => '808080',
                'ordering' => 0,
                'created_at' => '2020-11-18 16:02:56',
                'updated_at' => '2020-11-18 16:02:56',
            ),
            12 =>
            array (
                'id' => 16,
                'name' => '{"hy":"Վարդագույն","ru":"Розовый","en":"Pink"}',
                'hex_color' => 'ff1491',
                'ordering' => 0,
                'created_at' => '2020-11-18 16:07:41',
                'updated_at' => '2020-11-18 16:07:41',
            ),
            13 =>
            array (
                'id' => 17,
                'name' => '{"hy":"Մանուշակագույն","ru":"Фиолетовый","en":"Purple"}',
                'hex_color' => '800080',
                'ordering' => 0,
                'created_at' => '2020-11-18 16:08:47',
                'updated_at' => '2020-11-18 16:08:47',
            ),
            14 =>
            array (
                'id' => 18,
                'name' => '{"hy":"Դեղնաշագանակագույն","ru":"Желто-коричневый","en":"Sandy Brown"}',
                'hex_color' => 'f4a560',
                'ordering' => 0,
                'created_at' => '2020-11-18 16:16:36',
                'updated_at' => '2020-11-18 16:16:36',
            ),
            15 =>
            array (
                'id' => 19,
                'name' => '{"hy":"Կապտասև","ru":"Сине-черный","en":"Midnight Blue"}',
                'hex_color' => '191970',
                'ordering' => 0,
                'created_at' => '2020-11-18 16:19:23',
                'updated_at' => '2020-11-18 16:19:23',
            ),
            16 =>
            array (
                'id' => 20,
                'name' => '{"hy":"Փիրուզագույն","ru":"Бирюзовый","en":"Turquoise"}',
                'hex_color' => '40e0d0',
                'ordering' => 0,
                'created_at' => '2020-11-18 16:22:02',
                'updated_at' => '2020-11-18 16:22:02',
            ),
            17 =>
            array (
                'id' => 21,
                'name' => '{"hy":"Երկնագույն","ru":"Небесно-голубой","en":"SkyBlue"}',
                'hex_color' => '87cfeb',
                'ordering' => 0,
                'created_at' => '2020-11-18 16:39:30',
                'updated_at' => '2020-11-18 16:39:30',
            ),
        ));


    }
}
