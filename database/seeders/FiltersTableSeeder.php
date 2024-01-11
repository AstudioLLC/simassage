<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class FiltersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('filters')->delete();

        \DB::table('filters')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => '{"hy":"Չափս","ru":"Размер","en":"Size"}',
                'is_active' => 1,
                'ordering' => 0,
                'created_at' => '2020-11-16 12:30:43',
                'updated_at' => '2020-11-16 12:30:43',
            ),
            1 =>
            array (
                'id' => 2,
                'name' => '{"hy":"Հաստություն","ru":"Толщина","en":"Thickness"}',
                'is_active' => 1,
                'ordering' => 0,
                'created_at' => '2020-11-16 12:34:23',
                'updated_at' => '2020-11-16 12:34:23',
            ),
            2 =>
            array (
                'id' => 3,
                'name' => '{"hy":"Արտադրող երկիր","ru":"Страна производителя","en":"Manufacturer country"}',
                'is_active' => 1,
                'ordering' => 0,
                'created_at' => '2020-11-16 12:49:49',
                'updated_at' => '2020-11-16 12:49:49',
            ),
            3 =>
            array (
                'id' => 4,
                'name' => '{"hy":"Երեսպատման նյութ","ru":"Материал облицовки","en":"Facing material"}',
                'is_active' => 1,
                'ordering' => 0,
                'created_at' => '2020-11-16 13:18:22',
                'updated_at' => '2020-11-16 15:51:12',
            ),
            4 =>
            array (
                'id' => 5,
                'name' => '{"hy":"Քարի տեսակ","ru":"Тип камня","en":"Stone type"}',
                'is_active' => 1,
                'ordering' => 0,
                'created_at' => '2020-11-16 13:26:19',
                'updated_at' => '2020-11-16 15:50:18',
            ),
            5 =>
            array (
                'id' => 6,
                'name' => '{"hy":"Հատակի նյութ","ru":"Материал пола","en":"Floor material"}',
                'is_active' => 1,
                'ordering' => 0,
                'created_at' => '2020-11-16 14:21:23',
                'updated_at' => '2020-11-16 14:21:23',
            ),
            6 =>
            array (
                'id' => 7,
                'name' => '{"hy":"Փայտի տեսակ","ru":"Тип дерева","en":"Tree type"}',
                'is_active' => 1,
                'ordering' => 0,
                'created_at' => '2020-11-16 14:32:58',
                'updated_at' => '2020-11-16 14:32:58',
            ),
            7 =>
            array (
                'id' => 8,
                'name' => '{"hy":"Մակերես","ru":"Поверхность","en":"Surface"}',
                'is_active' => 1,
                'ordering' => 0,
                'created_at' => '2020-11-16 15:09:32',
                'updated_at' => '2020-11-16 15:09:32',
            ),
        ));


    }
}
