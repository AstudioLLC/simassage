<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CriteriaTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('criteria')->delete();

        \DB::table('criteria')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => '{"hy":"15х15 սմ","ru":"15х15 см","en":"15х15 sm"}',
                'filter_id' => 1,
                'created_at' => '2020-11-16 12:30:43',
                'updated_at' => '2020-11-16 12:30:43',
            ),
            1 =>
            array (
                'id' => 2,
                'name' => '{"hy":"25x21,6 սմ","ru":"25x21,6 см","en":"25x21,6 sm"}',
                'filter_id' => 1,
                'created_at' => '2020-11-16 12:30:43',
                'updated_at' => '2020-11-16 12:30:43',
            ),
            2 =>
            array (
                'id' => 3,
                'name' => '{"hy":"23x100 սմ","ru":"23x100 см","en":"23x100 sm"}',
                'filter_id' => 1,
                'created_at' => '2020-11-16 12:30:43',
                'updated_at' => '2020-11-16 12:30:43',
            ),
            3 =>
            array (
                'id' => 4,
                'name' => '{"hy":"32,5x32,5 սմ","ru":"32,5x32,5 см","en":"32,5x32,5 sm"}',
                'filter_id' => 1,
                'created_at' => '2020-11-16 12:30:43',
                'updated_at' => '2020-11-16 12:30:43',
            ),
            4 =>
            array (
                'id' => 5,
                'name' => '{"hy":"33.6x33.6 սմ","ru":"33.6x33.6 см","en":"33.6x33.6 sm"}',
                'filter_id' => 1,
                'created_at' => '2020-11-16 12:30:43',
                'updated_at' => '2020-11-16 12:30:43',
            ),
            5 =>
            array (
                'id' => 6,
                'name' => '{"hy":"34х34 սմ","ru":"34х34 см","en":"34х34 sm"}',
                'filter_id' => 1,
                'created_at' => '2020-11-16 12:30:43',
                'updated_at' => '2020-11-16 12:30:43',
            ),
            6 =>
            array (
                'id' => 7,
                'name' => '{"hy":"42х42 սմ","ru":"42х42 см","en":"42х42 sm"}',
                'filter_id' => 1,
                'created_at' => '2020-11-16 12:30:43',
                'updated_at' => '2020-11-16 12:30:43',
            ),
            7 =>
            array (
                'id' => 8,
                'name' => '{"hy":"49х49 սմ","ru":"49х49 см","en":"49х49 sm"}',
                'filter_id' => 1,
                'created_at' => '2020-11-16 12:30:43',
                'updated_at' => '2020-11-16 12:30:43',
            ),
            8 =>
            array (
                'id' => 9,
                'name' => '{"hy":"50х100 սմ","ru":"50х100 см","en":"50х100 sm"}',
                'filter_id' => 1,
                'created_at' => '2020-11-16 12:30:43',
                'updated_at' => '2020-11-16 12:30:43',
            ),
            9 =>
            array (
                'id' => 10,
                'name' => '{"hy":"59.5x119.2 սմ","ru":"59.5x119.2 см","en":"59.5x119.2 sm"}',
                'filter_id' => 1,
                'created_at' => '2020-11-16 12:30:43',
                'updated_at' => '2020-11-16 12:30:43',
            ),
            10 =>
            array (
                'id' => 11,
                'name' => '{"hy":"60x60 սմ","ru":"60x60 см","en":"60x60 sm"}',
                'filter_id' => 1,
                'created_at' => '2020-11-16 12:30:43',
                'updated_at' => '2020-11-16 12:30:43',
            ),
            11 =>
            array (
                'id' => 12,
                'name' => '{"hy":"75,5X151 սմ","ru":"75,5X151 см","en":"75,5X151 sm"}',
                'filter_id' => 1,
                'created_at' => '2020-11-16 12:30:43',
                'updated_at' => '2020-11-16 12:30:43',
            ),
            12 =>
            array (
                'id' => 13,
                'name' => '{"hy":"9 մմ","ru":"9 мм","en":"9 mm"}',
                'filter_id' => 2,
                'created_at' => '2020-11-16 12:34:23',
                'updated_at' => '2020-11-16 12:34:23',
            ),
            13 =>
            array (
                'id' => 14,
                'name' => '{"hy":"10 մմ","ru":"10 мм","en":"10 mm"}',
                'filter_id' => 2,
                'created_at' => '2020-11-16 12:34:23',
                'updated_at' => '2020-11-16 12:34:23',
            ),
            14 =>
            array (
                'id' => 15,
                'name' => '{"hy":"12 մմ","ru":"12 мм","en":"12 мм"}',
                'filter_id' => 2,
                'created_at' => '2020-11-16 12:34:23',
                'updated_at' => '2020-11-16 12:34:23',
            ),
            15 =>
            array (
                'id' => 16,
                'name' => '{"hy":"Հայաստան","ru":"Армения","en":"Armenia"}',
                'filter_id' => 3,
                'created_at' => '2020-11-16 12:49:49',
                'updated_at' => '2020-11-16 12:49:49',
            ),
            16 =>
            array (
                'id' => 17,
                'name' => '{"hy":"Ռուսաստան","ru":"Россия","en":"Russia"}',
                'filter_id' => 3,
                'created_at' => '2020-11-16 12:49:49',
                'updated_at' => '2020-11-16 12:49:49',
            ),
            17 =>
            array (
                'id' => 18,
                'name' => '{"hy":"Իրան","ru":"Иран","en":"Iran"}',
                'filter_id' => 3,
                'created_at' => '2020-11-16 12:49:49',
                'updated_at' => '2020-11-16 12:49:49',
            ),
            18 =>
            array (
                'id' => 19,
                'name' => '{"hy":"Իտալիա","ru":"Италия","en":"Italy"}',
                'filter_id' => 3,
                'created_at' => '2020-11-16 12:49:49',
                'updated_at' => '2020-11-16 12:49:49',
            ),
            19 =>
            array (
                'id' => 20,
                'name' => '{"hy":"Իսպանիա","ru":"Испания","en":"Spain"}',
                'filter_id' => 3,
                'created_at' => '2020-11-16 12:49:49',
                'updated_at' => '2020-11-16 12:49:49',
            ),
            20 =>
            array (
                'id' => 21,
                'name' => '{"hy":"\\u0532\\u0576\\u0561\\u056f\\u0561\\u0576 \\u056f\\u0561\\u0574 \\u0561\\u0580\\u0570\\u0565\\u057d\\u057f\\u0561\\u056f\\u0561\\u0576 \\u0584\\u0561\\u0580","ru":"\\u0418\\u0441\\u043a\\u0443\\u0441\\u0441\\u0442\\u0432\\u0435\\u043d\\u043d\\u044b\\u0439 \\u0438\\u043b\\u0438 \\u043d\\u0430\\u0442\\u0443\\u0440\\u0430\\u043b\\u044c\\u043d\\u044b\\u0439 \\u043a\\u0430\\u043c\\u0435\\u043d\\u044c","en":"Artificial or natural stone"}',
                'filter_id' => 4,
                'created_at' => '2020-11-16 13:18:22',
                'updated_at' => '2020-11-16 15:51:12',
            ),
            21 =>
            array (
                'id' => 22,
                'name' => '{"hy":"\\u053f\\u056c\\u056b\\u0576\\u056f\\u0565\\u0580\\u0561\\u0575\\u056b\\u0576 \\u057d\\u0561\\u056c\\u056b\\u056f\\u0576\\u0565\\u0580","ru":"\\u041a\\u043b\\u0438\\u043d\\u043a\\u0435\\u0440\\u043d\\u0430\\u044f \\u043f\\u043b\\u0438\\u0442\\u043a\\u0430","en":"Clinker tiles"}',
                'filter_id' => 4,
                'created_at' => '2020-11-16 13:18:22',
                'updated_at' => '2020-11-16 15:51:12',
            ),
            22 =>
            array (
                'id' => 23,
                'name' => '{"hy":"\\u053f\\u0565\\u0580\\u0561\\u0574\\u0578\\u0563\\u0580\\u0561\\u0576\\u056b\\u057f","ru":"\\u041a\\u0435\\u0440\\u0430\\u043c\\u043e\\u0433\\u0440\\u0430\\u043d\\u0438\\u0442","en":"Porcelain stoneware"}',
                'filter_id' => 4,
                'created_at' => '2020-11-16 13:18:22',
                'updated_at' => '2020-11-16 15:51:12',
            ),
            23 =>
            array (
                'id' => 24,
                'name' => '{"hy":"\\u054d\\u0565\\u0576\\u0564\\u057e\\u056b\\u0579 \\u057a\\u0561\\u0576\\u0565\\u056c","ru":"\\u0421\\u044d\\u043d\\u0434\\u0432\\u0438\\u0447-\\u043f\\u0430\\u043d\\u0435\\u043b\\u044c","en":"Sandwich panel"}',
                'filter_id' => 4,
                'created_at' => '2020-11-16 13:18:22',
                'updated_at' => '2020-11-16 15:51:12',
            ),
            24 =>
            array (
                'id' => 25,
                'name' => '{"hy":"\\u0533\\u0580\\u0561\\u0576\\u056b\\u057f","ru":"\\u0413\\u0440\\u0430\\u043d\\u0438\\u0442","en":"Granite"}',
                'filter_id' => 5,
                'created_at' => '2020-11-16 13:26:19',
                'updated_at' => '2020-11-16 15:50:18',
            ),
            25 =>
            array (
                'id' => 26,
                'name' => '{"hy":"\\u0532\\u0561\\u0566\\u0561\\u056c\\u057f","ru":"\\u0411\\u0430\\u0437\\u0430\\u043b\\u044c\\u0442","en":"Basalt"}',
                'filter_id' => 5,
                'created_at' => '2020-11-16 13:26:19',
                'updated_at' => '2020-11-16 15:50:18',
            ),
            26 =>
            array (
                'id' => 27,
                'name' => '{"hy":"\\u0554\\u057e\\u0561\\u0580\\u0581\\u056b\\u057f","ru":"\\u041a\\u0432\\u0430\\u0440\\u0446\\u0438\\u0442","en":"Quartzite"}',
                'filter_id' => 5,
                'created_at' => '2020-11-16 13:26:19',
                'updated_at' => '2020-11-16 15:50:18',
            ),
            27 =>
            array (
                'id' => 28,
                'name' => '{"hy":"\\u0544\\u0561\\u0580\\u0574\\u0561\\u0580","ru":"\\u041c\\u0440\\u0430\\u043c\\u043e\\u0440","en":"Marble"}',
                'filter_id' => 5,
                'created_at' => '2020-11-16 13:26:19',
                'updated_at' => '2020-11-16 15:50:18',
            ),
            28 =>
            array (
                'id' => 29,
                'name' => '{"hy":"\\u053f\\u0580\\u0561\\u0584\\u0561\\u0580","ru":"\\u0418\\u0437\\u0432\\u0435\\u0441\\u0442\\u043d\\u044f\\u043a","en":"Limestone"}',
                'filter_id' => 5,
                'created_at' => '2020-11-16 13:26:19',
                'updated_at' => '2020-11-16 15:50:18',
            ),
            29 =>
            array (
                'id' => 30,
                'name' => '{"hy":"\\u054f\\u0578\\u0582\\u0586","ru":"\\u0422\\u0443\\u0444","en":"Tufa"}',
                'filter_id' => 5,
                'created_at' => '2020-11-16 13:26:19',
                'updated_at' => '2020-11-16 15:50:18',
            ),
            30 =>
            array (
                'id' => 31,
                'name' => '{"hy":"Լինոլեում","ru":"Линолеум","en":"Linoleum"}',
                'filter_id' => 6,
                'created_at' => '2020-11-16 14:21:23',
                'updated_at' => '2020-11-16 14:21:23',
            ),
            31 =>
            array (
                'id' => 32,
                'name' => '{"hy":"Կովրոլին","ru":"Ковролин","en":"Fitted carpet"}',
                'filter_id' => 6,
                'created_at' => '2020-11-16 14:21:23',
                'updated_at' => '2020-11-16 14:21:23',
            ),
            32 =>
            array (
                'id' => 33,
                'name' => '{"hy":"Արհեստական խոտ","ru":"Искусственная трава","en":"Artificial grass"}',
                'filter_id' => 6,
                'created_at' => '2020-11-16 14:21:23',
                'updated_at' => '2020-11-16 14:21:23',
            ),
            33 =>
            array (
                'id' => 34,
                'name' => '{"hy":"Մանրահատակի տախտակ","ru":"Паркетная доска","en":"Parquet board"}',
                'filter_id' => 6,
                'created_at' => '2020-11-16 14:21:23',
                'updated_at' => '2020-11-16 14:21:23',
            ),
            34 =>
            array (
                'id' => 35,
                'name' => '{"hy":"Հատային մանրահատակ","ru":"Штучный паркет","en":"Block parquet"}',
                'filter_id' => 6,
                'created_at' => '2020-11-16 14:21:23',
                'updated_at' => '2020-11-16 14:21:23',
            ),
            35 =>
            array (
                'id' => 36,
                'name' => '{"hy":"Ամուր տախտակ","ru":"Массивная доска","en":"Solid wood"}',
                'filter_id' => 6,
                'created_at' => '2020-11-16 14:21:23',
                'updated_at' => '2020-11-16 14:21:23',
            ),
            36 =>
            array (
                'id' => 37,
                'name' => '{"hy":"Այլ","ru":"Другое","en":"Other"}',
                'filter_id' => 6,
                'created_at' => '2020-11-16 14:21:23',
                'updated_at' => '2020-11-16 14:21:23',
            ),
            37 =>
            array (
                'id' => 38,
                'name' => '{"hy":"Կաղնի","ru":"Дуб","en":"Oak"}',
                'filter_id' => 7,
                'created_at' => '2020-11-16 14:32:58',
                'updated_at' => '2020-11-16 14:32:58',
            ),
            38 =>
            array (
                'id' => 39,
                'name' => '{"hy":"Թխկի","ru":"Клен","en":"Maple"}',
                'filter_id' => 7,
                'created_at' => '2020-11-16 14:32:58',
                'updated_at' => '2020-11-16 14:32:58',
            ),
            39 =>
            array (
                'id' => 40,
                'name' => '{"hy":"Ընկուզենի","ru":"Орех","en":"Nut"}',
                'filter_id' => 7,
                'created_at' => '2020-11-16 14:32:58',
                'updated_at' => '2020-11-16 14:32:58',
            ),
            40 =>
            array (
                'id' => 41,
                'name' => '{"hy":"Սոճի","ru":"Сосна","en":"Pine"}',
                'filter_id' => 7,
                'created_at' => '2020-11-16 14:32:58',
                'updated_at' => '2020-11-16 14:32:58',
            ),
            41 =>
            array (
                'id' => 42,
                'name' => '{"hy":"Այլ տեսակներ","ru":"Другие типы","en":"Other types"}',
                'filter_id' => 7,
                'created_at' => '2020-11-16 14:32:58',
                'updated_at' => '2020-11-16 14:32:58',
            ),
            42 =>
            array (
                'id' => 43,
                'name' => '{"hy":"Անփայլ","ru":"Матовая","en":"Matte"}',
                'filter_id' => 8,
                'created_at' => '2020-11-16 15:09:32',
                'updated_at' => '2020-11-16 15:09:32',
            ),
            43 =>
            array (
                'id' => 44,
                'name' => '{"hy":"Փայլող","ru":"Глянцевая","en":"Glossy"}',
                'filter_id' => 8,
                'created_at' => '2020-11-16 15:09:32',
                'updated_at' => '2020-11-16 15:09:32',
            ),
            44 =>
            array (
                'id' => 45,
                'name' => '{"hy":"Ռուստիկ","ru":"Рустика","en":"Rustic"}',
                'filter_id' => 8,
                'created_at' => '2020-11-16 15:09:32',
                'updated_at' => '2020-11-16 15:09:32',
            ),
            45 =>
            array (
                'id' => 46,
                'name' => '{"hy":"Հարթ","ru":"Гладкий","en":"Smooth"}',
                'filter_id' => 8,
                'created_at' => '2020-11-16 15:09:32',
                'updated_at' => '2020-11-16 15:09:32',
            ),
            46 =>
            array (
                'id' => 47,
                'name' => '{"hy":"3D սալիկ","ru":"3D плитка","en":"3D tiles"}',
                'filter_id' => 8,
                'created_at' => '2020-11-16 15:09:32',
                'updated_at' => '2020-11-16 15:09:32',
            ),
            47 =>
            array (
                'id' => 48,
                'name' => '{"hy":"Այլ","ru":"Другие","en":"Other"}',
                'filter_id' => 8,
                'created_at' => '2020-11-16 15:09:32',
                'updated_at' => '2020-11-16 15:09:32',
            ),
            48 =>
            array (
                'id' => 49,
                'name' => '{"hy":"Այլ քարեր","ru":"Другие камни","en":"Other stones"}',
                'filter_id' => 5,
                'created_at' => '2020-11-16 15:50:18',
                'updated_at' => '2020-11-16 15:50:18',
            ),
        ));


    }
}
