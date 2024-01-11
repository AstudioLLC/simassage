<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ItemCriterionReferencesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('item_criterion_references')->delete();

        \DB::table('item_criterion_references')->insert(array (
            0 =>
            array (
                'id' => 1,
                'item_id' => 1,
                'criterion_id' => 13,
            ),
            1 =>
            array (
                'id' => 2,
                'item_id' => 1,
                'criterion_id' => 14,
            ),
            2 =>
            array (
                'id' => 3,
                'item_id' => 1,
                'criterion_id' => 15,
            ),
            3 =>
            array (
                'id' => 4,
                'item_id' => 1,
                'criterion_id' => 11,
            ),
            4 =>
            array (
                'id' => 5,
                'item_id' => 2,
                'criterion_id' => 13,
            ),
            5 =>
            array (
                'id' => 6,
                'item_id' => 2,
                'criterion_id' => 14,
            ),
            6 =>
            array (
                'id' => 7,
                'item_id' => 2,
                'criterion_id' => 15,
            ),
            7 =>
            array (
                'id' => 8,
                'item_id' => 2,
                'criterion_id' => 11,
            ),
            8 =>
            array (
                'id' => 9,
                'item_id' => 3,
                'criterion_id' => 13,
            ),
            9 =>
            array (
                'id' => 10,
                'item_id' => 3,
                'criterion_id' => 14,
            ),
            10 =>
            array (
                'id' => 11,
                'item_id' => 3,
                'criterion_id' => 15,
            ),
            11 =>
            array (
                'id' => 12,
                'item_id' => 3,
                'criterion_id' => 43,
            ),
            12 =>
            array (
                'id' => 13,
                'item_id' => 3,
                'criterion_id' => 44,
            ),
            13 =>
            array (
                'id' => 14,
                'item_id' => 3,
                'criterion_id' => 48,
            ),
            14 =>
            array (
                'id' => 15,
                'item_id' => 4,
                'criterion_id' => 13,
            ),
            15 =>
            array (
                'id' => 16,
                'item_id' => 4,
                'criterion_id' => 14,
            ),
            16 =>
            array (
                'id' => 17,
                'item_id' => 4,
                'criterion_id' => 15,
            ),
            17 =>
            array (
                'id' => 18,
                'item_id' => 4,
                'criterion_id' => 48,
            ),
            18 =>
            array (
                'id' => 19,
                'item_id' => 4,
                'criterion_id' => 43,
            ),
            19 =>
            array (
                'id' => 20,
                'item_id' => 5,
                'criterion_id' => 29,
            ),
            20 =>
            array (
                'id' => 21,
                'item_id' => 6,
                'criterion_id' => 49,
            ),
            21 =>
            array (
                'id' => 22,
                'item_id' => 7,
                'criterion_id' => 49,
            ),
            22 =>
            array (
                'id' => 23,
                'item_id' => 8,
                'criterion_id' => 49,
            ),
            23 =>
            array (
                'id' => 24,
                'item_id' => 9,
                'criterion_id' => 49,
            ),
            24 =>
            array (
                'id' => 25,
                'item_id' => 10,
                'criterion_id' => 49,
            ),
            25 =>
            array (
                'id' => 26,
                'item_id' => 11,
                'criterion_id' => 49,
            ),
            26 =>
            array (
                'id' => 27,
                'item_id' => 12,
                'criterion_id' => 49,
            ),
            27 =>
            array (
                'id' => 28,
                'item_id' => 13,
                'criterion_id' => 49,
            ),
            28 =>
            array (
                'id' => 29,
                'item_id' => 14,
                'criterion_id' => 27,
            ),
            29 =>
            array (
                'id' => 30,
                'item_id' => 15,
                'criterion_id' => 49,
            ),
            30 =>
            array (
                'id' => 31,
                'item_id' => 16,
                'criterion_id' => 25,
            ),
            31 =>
            array (
                'id' => 38,
                'item_id' => 18,
                'criterion_id' => 43,
            ),
            32 =>
            array (
                'id' => 39,
                'item_id' => 18,
                'criterion_id' => 44,
            ),
            33 =>
            array (
                'id' => 40,
                'item_id' => 18,
                'criterion_id' => 45,
            ),
            34 =>
            array (
                'id' => 41,
                'item_id' => 18,
                'criterion_id' => 46,
            ),
            35 =>
            array (
                'id' => 42,
                'item_id' => 18,
                'criterion_id' => 47,
            ),
            36 =>
            array (
                'id' => 43,
                'item_id' => 18,
                'criterion_id' => 48,
            ),
            37 =>
            array (
                'id' => 44,
                'item_id' => 19,
                'criterion_id' => 43,
            ),
            38 =>
            array (
                'id' => 45,
                'item_id' => 19,
                'criterion_id' => 44,
            ),
            39 =>
            array (
                'id' => 46,
                'item_id' => 19,
                'criterion_id' => 45,
            ),
            40 =>
            array (
                'id' => 47,
                'item_id' => 19,
                'criterion_id' => 46,
            ),
            41 =>
            array (
                'id' => 48,
                'item_id' => 19,
                'criterion_id' => 47,
            ),
            42 =>
            array (
                'id' => 49,
                'item_id' => 19,
                'criterion_id' => 48,
            ),
            43 =>
            array (
                'id' => 50,
                'item_id' => 20,
                'criterion_id' => 43,
            ),
            44 =>
            array (
                'id' => 51,
                'item_id' => 20,
                'criterion_id' => 44,
            ),
            45 =>
            array (
                'id' => 52,
                'item_id' => 20,
                'criterion_id' => 45,
            ),
            46 =>
            array (
                'id' => 53,
                'item_id' => 20,
                'criterion_id' => 46,
            ),
            47 =>
            array (
                'id' => 54,
                'item_id' => 20,
                'criterion_id' => 47,
            ),
            48 =>
            array (
                'id' => 55,
                'item_id' => 20,
                'criterion_id' => 48,
            ),
            49 =>
            array (
                'id' => 56,
                'item_id' => 17,
                'criterion_id' => 43,
            ),
            50 =>
            array (
                'id' => 57,
                'item_id' => 17,
                'criterion_id' => 46,
            ),
            51 =>
            array (
                'id' => 58,
                'item_id' => 17,
                'criterion_id' => 48,
            ),
        ));


    }
}
