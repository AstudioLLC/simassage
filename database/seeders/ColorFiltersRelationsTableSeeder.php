<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ColorFiltersRelationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('color_filters_relations')->delete();

        \DB::table('color_filters_relations')->insert(array (
            0 =>
            array (
                'id' => 3,
                'item_id' => 1,
                'filter_id' => 13,
            ),
            1 =>
            array (
                'id' => 4,
                'item_id' => 2,
                'filter_id' => 13,
            ),
            2 =>
            array (
                'id' => 5,
                'item_id' => 3,
                'filter_id' => 13,
            ),
            3 =>
            array (
                'id' => 6,
                'item_id' => 5,
                'filter_id' => 16,
            ),
            4 =>
            array (
                'id' => 7,
                'item_id' => 6,
                'filter_id' => 15,
            ),
            5 =>
            array (
                'id' => 8,
                'item_id' => 6,
                'filter_id' => 4,
            ),
            6 =>
            array (
                'id' => 9,
                'item_id' => 7,
                'filter_id' => 18,
            ),
            7 =>
            array (
                'id' => 10,
                'item_id' => 7,
                'filter_id' => 13,
            ),
            8 =>
            array (
                'id' => 11,
                'item_id' => 7,
                'filter_id' => 10,
            ),
            9 =>
            array (
                'id' => 12,
                'item_id' => 7,
                'filter_id' => 8,
            ),
            10 =>
            array (
                'id' => 13,
                'item_id' => 8,
                'filter_id' => 18,
            ),
            11 =>
            array (
                'id' => 14,
                'item_id' => 8,
                'filter_id' => 13,
            ),
            12 =>
            array (
                'id' => 15,
                'item_id' => 8,
                'filter_id' => 10,
            ),
            13 =>
            array (
                'id' => 16,
                'item_id' => 8,
                'filter_id' => 8,
            ),
            14 =>
            array (
                'id' => 17,
                'item_id' => 9,
                'filter_id' => 16,
            ),
            15 =>
            array (
                'id' => 18,
                'item_id' => 9,
                'filter_id' => 7,
            ),
            16 =>
            array (
                'id' => 19,
                'item_id' => 11,
                'filter_id' => 19,
            ),
            17 =>
            array (
                'id' => 20,
                'item_id' => 11,
                'filter_id' => 11,
            ),
            18 =>
            array (
                'id' => 21,
                'item_id' => 11,
                'filter_id' => 5,
            ),
            19 =>
            array (
                'id' => 22,
                'item_id' => 12,
                'filter_id' => 15,
            ),
            20 =>
            array (
                'id' => 23,
                'item_id' => 12,
                'filter_id' => 14,
            ),
            21 =>
            array (
                'id' => 24,
                'item_id' => 13,
                'filter_id' => 17,
            ),
            22 =>
            array (
                'id' => 25,
                'item_id' => 13,
                'filter_id' => 8,
            ),
            23 =>
            array (
                'id' => 26,
                'item_id' => 14,
                'filter_id' => 6,
            ),
            24 =>
            array (
                'id' => 27,
                'item_id' => 15,
                'filter_id' => 20,
            ),
            25 =>
            array (
                'id' => 28,
                'item_id' => 17,
                'filter_id' => 20,
            ),
            26 =>
            array (
                'id' => 29,
                'item_id' => 17,
                'filter_id' => 11,
            ),
            27 =>
            array (
                'id' => 30,
                'item_id' => 17,
                'filter_id' => 21,
            ),
            28 =>
            array (
                'id' => 31,
                'item_id' => 19,
                'filter_id' => 15,
            ),
            29 =>
            array (
                'id' => 32,
                'item_id' => 19,
                'filter_id' => 5,
            ),
            30 =>
            array (
                'id' => 33,
                'item_id' => 20,
                'filter_id' => 15,
            ),
            31 =>
            array (
                'id' => 34,
                'item_id' => 20,
                'filter_id' => 14,
            ),
        ));


    }
}
