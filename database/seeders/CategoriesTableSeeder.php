<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('categories')->delete();

        \DB::table('categories')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => '{"hy":"Керамические плитки","ru":"Керамические плитки","en":"Керамические плитки"}',
                'parent_id' => NULL,
                'is_footer' => 0,
                'deep' => 0,
                'alias' => 'keramiceskie-plitki',
                'seo_title' => NULL,
                'seo_description' => NULL,
                'seo_keywords' => NULL,
                'ordering' => 1,
                'created_at' => '2020-11-11 14:46:07',
                'updated_at' => '2020-11-17 12:07:07',
            ),
            1 =>
            array (
                'id' => 2,
                'name' => '{"hy":"Санитарная керамика","ru":"Санитарная керамика","en":"Санитарная керамика"}',
                'parent_id' => NULL,
                'is_footer' => 0,
                'deep' => 0,
                'alias' => 'sanitarnaya-keramika',
                'seo_title' => NULL,
                'seo_description' => NULL,
                'seo_keywords' => NULL,
                'ordering' => 5,
                'created_at' => '2020-11-11 14:46:40',
                'updated_at' => '2020-11-17 12:07:07',
            ),
            2 =>
            array (
                'id' => 3,
                'name' => '{"hy":"Камни","ru":"Камни","en":"Камни"}',
                'parent_id' => NULL,
                'is_footer' => 0,
                'deep' => 0,
                'alias' => 'kamni',
                'seo_title' => NULL,
                'seo_description' => NULL,
                'seo_keywords' => NULL,
                'ordering' => 4,
                'created_at' => '2020-11-11 14:46:48',
                'updated_at' => '2020-11-17 12:07:07',
            ),
            3 =>
            array (
                'id' => 4,
                'name' => '{"hy":"Напольное покрытие","ru":"Напольное покрытие","en":"Напольное покрытие"}',
                'parent_id' => NULL,
                'is_footer' => 0,
                'deep' => 0,
                'alias' => 'napolnoe-pokrytie',
                'seo_title' => NULL,
                'seo_description' => NULL,
                'seo_keywords' => NULL,
                'ordering' => 3,
                'created_at' => '2020-11-11 14:46:55',
                'updated_at' => '2020-11-17 12:07:07',
            ),
            4 =>
            array (
                'id' => 5,
                'name' => '{"hy":"Облицовочные материалы","ru":"Облицовочные материалы","en":"Облицовочные материалы"}',
                'parent_id' => NULL,
                'is_footer' => 0,
                'deep' => 0,
                'alias' => 'oblicovocnye-materialy',
                'seo_title' => NULL,
                'seo_description' => NULL,
                'seo_keywords' => NULL,
                'ordering' => 2,
                'created_at' => '2020-11-11 14:47:01',
                'updated_at' => '2020-11-17 12:07:07',
            ),
            5 =>
            array (
                'id' => 6,
                'name' => '{"hy":"Настенные плитки","ru":"Настенные плитки","en":"Настенные плитки"}',
                'parent_id' => 1,
                'is_footer' => 0,
                'deep' => 1,
                'alias' => 'nastennye-plitki',
                'seo_title' => NULL,
                'seo_description' => NULL,
                'seo_keywords' => NULL,
                'ordering' => 1,
                'created_at' => '2020-11-11 14:47:40',
                'updated_at' => '2020-11-11 14:48:17',
            ),
            6 =>
            array (
                'id' => 7,
                'name' => '{"hy":"Напольные плитки","ru":"Напольные плитки","en":"Напольные плитки"}',
                'parent_id' => 1,
                'is_footer' => 0,
                'deep' => 1,
                'alias' => 'napolnye-plitki',
                'seo_title' => NULL,
                'seo_description' => NULL,
                'seo_keywords' => NULL,
                'ordering' => 2,
                'created_at' => '2020-11-11 14:47:48',
                'updated_at' => '2020-11-11 14:48:17',
            ),
            7 =>
            array (
                'id' => 8,
                'name' => '{"hy":"Керамогранит","ru":"Керамогранит","en":"Керамогранит"}',
                'parent_id' => 1,
                'is_footer' => 0,
                'deep' => 1,
                'alias' => 'keramogranit',
                'seo_title' => NULL,
                'seo_description' => NULL,
                'seo_keywords' => NULL,
                'ordering' => 3,
                'created_at' => '2020-11-11 14:47:57',
                'updated_at' => '2020-11-11 14:48:17',
            ),
            8 =>
            array (
                'id' => 9,
                'name' => '{"hy":"Мозаика","ru":"Мозаика","en":"Мозаика"}',
                'parent_id' => 1,
                'is_footer' => 0,
                'deep' => 1,
                'alias' => 'mozaika',
                'seo_title' => NULL,
                'seo_description' => NULL,
                'seo_keywords' => NULL,
                'ordering' => 4,
                'created_at' => '2020-11-11 14:48:03',
                'updated_at' => '2020-11-11 14:48:17',
            ),
            9 =>
            array (
                'id' => 10,
                'name' => '{"hy":"Карнизы и декоры","ru":"Карнизы и декоры","en":"Карнизы и декоры"}',
                'parent_id' => 1,
                'is_footer' => 0,
                'deep' => 1,
                'alias' => 'karnizy-i-dekory',
                'seo_title' => NULL,
                'seo_description' => NULL,
                'seo_keywords' => NULL,
                'ordering' => 5,
                'created_at' => '2020-11-11 14:48:10',
                'updated_at' => '2020-11-11 14:48:17',
            ),
            10 =>
            array (
                'id' => 11,
                'name' => '{"hy":"Գրանիտ","ru":"Гранит","en":"Granite"}',
                'parent_id' => 3,
                'is_footer' => 0,
                'deep' => 0,
                'alias' => 'granite',
                'seo_title' => NULL,
                'seo_description' => NULL,
                'seo_keywords' => NULL,
                'ordering' => 0,
                'created_at' => '2020-11-16 15:36:18',
                'updated_at' => '2020-11-17 12:11:44',
            ),
            11 =>
            array (
                'id' => 12,
                'name' => '{"hy":"Նստակոնքեր և լվացարաններ","ru":"Унитазы и умывальники","en":"Toilets and washbasins"}',
                'parent_id' => 2,
                'is_footer' => 0,
                'deep' => 1,
                'alias' => 'toilets-and-washbasins',
                'seo_title' => NULL,
                'seo_description' => NULL,
                'seo_keywords' => NULL,
                'ordering' => 1,
                'created_at' => '2020-11-17 11:44:17',
                'updated_at' => '2020-11-17 12:05:35',
            ),
            12 =>
            array (
                'id' => 13,
                'name' => '{"hy":"Լոգասենյակի կահույք\\/ Հայելի","ru":"Мебель для ванной ком.\\/ Зеркало","en":"Furniture for bathrooms\\/ Mirrors"}',
                'parent_id' => 2,
                'is_footer' => 0,
                'deep' => 1,
                'alias' => 'furniture-for-bathrooms-mirrors',
                'seo_title' => NULL,
                'seo_description' => NULL,
                'seo_keywords' => NULL,
                'ordering' => 2,
                'created_at' => '2020-11-17 11:50:05',
                'updated_at' => '2020-11-17 12:05:35',
            ),
            13 =>
            array (
                'id' => 16,
                'name' => '{"hy":"Չուգունե և ակրիլե լոգարաններ","ru":"Чугунные и акриловые ванны","en":"Iron & acrylic bathtubs"}',
                'parent_id' => 2,
                'is_footer' => 0,
                'deep' => 1,
                'alias' => 'iron-acrylic-bathtubs',
                'seo_title' => NULL,
                'seo_description' => NULL,
                'seo_keywords' => NULL,
                'ordering' => 5,
                'created_at' => '2020-11-17 12:02:22',
                'updated_at' => '2020-11-17 12:05:35',
            ),
            14 =>
            array (
                'id' => 18,
                'name' => '{"hy":"Լոգախցիկներ","ru":"Гидромассажные кабины","en":"Massage bathtubs"}',
                'parent_id' => 2,
                'is_footer' => 0,
                'deep' => 1,
                'alias' => 'massage-bathtubs-2',
                'seo_title' => NULL,
                'seo_description' => NULL,
                'seo_keywords' => NULL,
                'ordering' => 3,
                'created_at' => '2020-11-17 12:05:23',
                'updated_at' => '2020-11-17 12:05:35',
            ),
            15 =>
            array (
                'id' => 19,
                'name' => '{"hy":"Հիդրոմերսող լոգարաններ","ru":"Гидромассажные ванны","en":"Hydromassage bathtubs"}',
                'parent_id' => 2,
                'is_footer' => 0,
                'deep' => 1,
                'alias' => 'hydromassage-bathtubs',
                'seo_title' => NULL,
                'seo_description' => NULL,
                'seo_keywords' => NULL,
                'ordering' => 0,
                'created_at' => '2020-11-17 12:08:56',
                'updated_at' => '2020-11-17 12:08:56',
            ),
            16 =>
            array (
                'id' => 20,
                'name' => '{"hy":"Այլ քարեր","ru":"Другие камни","en":"Other stones"}',
                'parent_id' => 3,
                'is_footer' => 0,
                'deep' => 1,
                'alias' => 'other-stones',
                'seo_title' => NULL,
                'seo_description' => NULL,
                'seo_keywords' => NULL,
                'ordering' => 0,
                'created_at' => '2020-11-17 12:11:01',
                'updated_at' => '2020-11-17 12:11:01',
            ),
            17 =>
            array (
                'id' => 22,
                'name' => '{"hy":"Մարմար","ru":"Мрамор","en":"Marble"}',
                'parent_id' => 3,
                'is_footer' => 0,
                'deep' => 1,
                'alias' => 'marble',
                'seo_title' => NULL,
                'seo_description' => NULL,
                'seo_keywords' => NULL,
                'ordering' => 0,
                'created_at' => '2020-11-17 12:14:01',
                'updated_at' => '2020-11-17 12:14:01',
            ),
            18 =>
            array (
                'id' => 23,
                'name' => '{"hy":"Օդափոխվող համակարգեր","ru":"Вентиляционные системы","en":"Ventilation systems"}',
                'parent_id' => 5,
                'is_footer' => 0,
                'deep' => 1,
                'alias' => 'ventilation-systems',
                'seo_title' => NULL,
                'seo_description' => NULL,
                'seo_keywords' => NULL,
                'ordering' => 0,
                'created_at' => '2020-11-17 12:21:20',
                'updated_at' => '2020-11-17 12:21:20',
            ),
            19 =>
            array (
                'id' => 24,
                'name' => '{"hy":"Ֆիբրոցեմենտային սալ","ru":"Фиброцементные плиты","en":"Fiber cement board"}',
                'parent_id' => 5,
                'is_footer' => 0,
                'deep' => 1,
                'alias' => 'fiber-cement-board',
                'seo_title' => NULL,
                'seo_description' => NULL,
                'seo_keywords' => NULL,
                'ordering' => 0,
                'created_at' => '2020-11-17 12:23:17',
                'updated_at' => '2020-11-17 12:23:17',
            ),
            20 =>
            array (
                'id' => 25,
                'name' => '{"hy":"Ալյումինե թերթեր պոլիմերային միջնաշերտով՝ ալիկաբոնդ","ru":"Алюминиевые композитные панели - алюкобонд","en":"Aluminum composite boards - alucobond"}',
                'parent_id' => 5,
                'is_footer' => 0,
                'deep' => 1,
                'alias' => 'aluminum-composite-boards-alucobond',
                'seo_title' => NULL,
                'seo_description' => NULL,
                'seo_keywords' => NULL,
                'ordering' => 0,
                'created_at' => '2020-11-17 12:24:58',
                'updated_at' => '2020-11-17 12:24:58',
            ),
        ));


    }
}
