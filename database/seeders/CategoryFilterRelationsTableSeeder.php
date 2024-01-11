<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategoryFilterRelationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('category_filter_relations')->delete();

        \DB::table('category_filter_relations')->insert(array (
            0 =>
            array (
                'id' => 3,
                'category_id' => 6,
                'filter_id' => 2,
            ),
            1 =>
            array (
                'id' => 4,
                'category_id' => 6,
                'filter_id' => 1,
            ),
            2 =>
            array (
                'id' => 13,
                'category_id' => 1,
                'filter_id' => 2,
            ),
            3 =>
            array (
                'id' => 14,
                'category_id' => 1,
                'filter_id' => 1,
            ),
            4 =>
            array (
                'id' => 15,
                'category_id' => 7,
                'filter_id' => 3,
            ),
            5 =>
            array (
                'id' => 16,
                'category_id' => 7,
                'filter_id' => 2,
            ),
            6 =>
            array (
                'id' => 17,
                'category_id' => 7,
                'filter_id' => 1,
            ),
            7 =>
            array (
                'id' => 18,
                'category_id' => 8,
                'filter_id' => 3,
            ),
            8 =>
            array (
                'id' => 19,
                'category_id' => 8,
                'filter_id' => 2,
            ),
            9 =>
            array (
                'id' => 20,
                'category_id' => 8,
                'filter_id' => 1,
            ),
            10 =>
            array (
                'id' => 21,
                'category_id' => 9,
                'filter_id' => 3,
            ),
            11 =>
            array (
                'id' => 24,
                'category_id' => 1,
                'filter_id' => 3,
            ),
            12 =>
            array (
                'id' => 25,
                'category_id' => 3,
                'filter_id' => 5,
            ),
            13 =>
            array (
                'id' => 26,
                'category_id' => 5,
                'filter_id' => 4,
            ),
            14 =>
            array (
                'id' => 27,
                'category_id' => 4,
                'filter_id' => 7,
            ),
            15 =>
            array (
                'id' => 28,
                'category_id' => 4,
                'filter_id' => 6,
            ),
            16 =>
            array (
                'id' => 29,
                'category_id' => 7,
                'filter_id' => 8,
            ),
            17 =>
            array (
                'id' => 31,
                'category_id' => 11,
                'filter_id' => 5,
            ),
            18 =>
            array (
                'id' => 32,
                'category_id' => 11,
                'filter_id' => 4,
            ),
            19 =>
            array (
                'id' => 33,
                'category_id' => 6,
                'filter_id' => 8,
            ),
            20 =>
            array (
                'id' => 34,
                'category_id' => 6,
                'filter_id' => 3,
            ),
            21 =>
            array (
                'id' => 35,
                'category_id' => 3,
                'filter_id' => 4,
            ),
        ));


    }
}
