<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PagesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('pages')->delete();

        \DB::table('pages')->insert(array (
            0 =>
            array (
                'id' => 1,
                'url' => 'home',
                'title' => '{"hy":"Գլխավոր","ru":"Главное","en":"Home"}',
                'image' => NULL,
                'show_image' => 1,
                'to_top' => 0,
                'to_menu' => 1,
                'to_footer' => 1,
                'content' => '{"en":null}',
                'title_content' => '{"en":null}',
                'static' => 'home',
                'active' => 1,
                'ordering' => 1,
                'seo_title' => '{"en":null}',
                'seo_description' => '{"en":null}',
                'seo_keywords' => '{"ru":null}',
                'created_at' => '2020-11-18 14:30:59',
                'updated_at' => '2020-11-18 15:49:37',
            ),
            1 =>
            array (
                'id' => 2,
                'url' => 'payment-and-delivery',
                'title' => '{"hy":"Առաքում և վճարում","ru":"Доставка и оплата","en":"Payment and delivery"}',
                'image' => NULL,
                'show_image' => 0,
                'to_top' => 1,
                'to_menu' => 0,
                'to_footer' => 1,
                'content' => '{"ru":null}',
                'title_content' => '{"ru":null}',
                'static' => 'paymentDelivery',
                'active' => 1,
                'ordering' => 7,
                'seo_title' => '{"en":null}',
                'seo_description' => '{"en":null}',
                'seo_keywords' => '{"ru":null}',
                'created_at' => '2020-11-18 14:34:04',
                'updated_at' => '2020-11-18 15:49:37',
            ),
            2 =>
            array (
                'id' => 3,
                'url' => 'interior-design',
                'title' => '{"hy":"Ինտերիեր-Դիզայն","ru":"Интерьер-Дизайн","en":"Interior-Design"}',
                'image' => NULL,
                'show_image' => 1,
                'to_top' => 0,
                'to_menu' => 1,
                'to_footer' => 1,
                'content' => '{"en":null}',
                'title_content' => '{"en":null}',
                'static' => 'interiorDesign',
                'active' => 1,
                'ordering' => 2,
                'seo_title' => '{"en":null}',
                'seo_description' => '{"en":null}',
                'seo_keywords' => '{"ru":null}',
                'created_at' => '2020-11-18 14:42:13',
                'updated_at' => '2020-11-18 15:49:37',
            ),
            3 =>
            array (
                'id' => 4,
                'url' => 'on-line-measurement',
                'title' => '{"hy":"On-Line Չափագրում","ru":"On-Line Измерение","en":"On-Line Measurement"}',
                'image' => NULL,
                'show_image' => 1,
                'to_top' => 0,
                'to_menu' => 1,
                'to_footer' => 1,
                'content' => '{"en":null}',
                'title_content' => '{"en":null}',
                'static' => 'measurement',
                'active' => 1,
                'ordering' => 3,
                'seo_title' => '{"en":null}',
                'seo_description' => '{"en":null}',
                'seo_keywords' => '{"ru":null}',
                'created_at' => '2020-11-18 14:46:31',
                'updated_at' => '2020-11-18 15:49:37',
            ),
            4 =>
            array (
                'id' => 5,
                'url' => 'discounts',
                'title' => '{"hy":"Զեղչեր","ru":"Скидки","en":"Discounts"}',
                'image' => NULL,
                'show_image' => 1,
                'to_top' => 0,
                'to_menu' => 1,
                'to_footer' => 1,
                'content' => '{"en":null}',
                'title_content' => '{"en":null}',
                'static' => 'discounts',
                'active' => 1,
                'ordering' => 4,
                'seo_title' => '{"en":null}',
                'seo_description' => '{"en":null}',
                'seo_keywords' => '{"ru":null}',
                'created_at' => '2020-11-18 14:49:04',
                'updated_at' => '2020-11-18 15:49:37',
            ),
            5 =>
            array (
                'id' => 6,
                'url' => 'promotions',
                'title' => '{"hy":"Ակցիաններ","ru":"Акции","en":"Promotions"}',
                'image' => NULL,
                'show_image' => 1,
                'to_top' => 0,
                'to_menu' => 1,
                'to_footer' => 1,
                'content' => '{"en":null}',
                'title_content' => '{"en":null}',
                'static' => 'promotions',
                'active' => 1,
                'ordering' => 5,
                'seo_title' => '{"en":null}',
                'seo_description' => '{"en":null}',
                'seo_keywords' => '{"ru":null}',
                'created_at' => '2020-11-18 14:52:44',
                'updated_at' => '2020-11-18 15:49:37',
            ),
            6 =>
            array (
                'id' => 7,
                'url' => 'news',
                'title' => '{"hy":"Նորություններ","ru":"Новости","en":"News"}',
                'image' => NULL,
                'show_image' => 0,
                'to_top' => 1,
                'to_menu' => 0,
                'to_footer' => 1,
                'content' => '{"ru":null}',
                'title_content' => '{"ru":null}',
                'static' => 'news',
                'active' => 1,
                'ordering' => 12,
                'seo_title' => '{"en":null}',
                'seo_description' => '{"en":null}',
                'seo_keywords' => '{"ru":null}',
                'created_at' => '2020-11-18 14:54:22',
                'updated_at' => '2020-11-18 15:49:37',
            ),
            7 =>
            array (
                'id' => 8,
                'url' => 'shops',
                'title' => '{"hy":"Վաճառասրահներ","ru":"Магазины","en":"Shops"}',
                'image' => NULL,
                'show_image' => 1,
                'to_top' => 1,
                'to_menu' => 0,
                'to_footer' => 1,
                'content' => '{"en":null}',
                'title_content' => '{"en":null}',
                'static' => 'shops',
                'active' => 1,
                'ordering' => 8,
                'seo_title' => '{"en":null}',
                'seo_description' => '{"en":null}',
                'seo_keywords' => '{"ru":null}',
                'created_at' => '2020-11-18 15:00:03',
                'updated_at' => '2020-11-18 15:49:37',
            ),
            8 =>
            array (
                'id' => 9,
                'url' => 'new-items',
                'title' => '{"hy":"Նորույթներ","ru":"Новинки","en":"New items"}',
                'image' => NULL,
                'show_image' => 1,
                'to_top' => 0,
                'to_menu' => 1,
                'to_footer' => 1,
                'content' => '{"en":null}',
                'title_content' => '{"en":null}',
                'static' => 'newItems',
                'active' => 1,
                'ordering' => 6,
                'seo_title' => '{"en":null}',
                'seo_description' => '{"en":null}',
                'seo_keywords' => '{"ru":null}',
                'created_at' => '2020-11-18 15:03:08',
                'updated_at' => '2020-11-18 15:49:37',
            ),
            9 =>
            array (
                'id' => 10,
                'url' => 'sale-on-credit',
                'title' => '{"hy":"Ապառիկ վաճառք","ru":"Продажа в кредит","en":"Sale on credit"}',
                'image' => NULL,
                'show_image' => 1,
                'to_top' => 1,
                'to_menu' => 0,
                'to_footer' => 1,
                'content' => '{"en":null}',
                'title_content' => '{"en":null}',
                'static' => 'loan',
                'active' => 1,
                'ordering' => 9,
                'seo_title' => '{"en":null}',
                'seo_description' => '{"en":null}',
                'seo_keywords' => '{"ru":null}',
                'created_at' => '2020-11-18 15:12:28',
                'updated_at' => '2020-11-18 15:49:37',
            ),
            10 =>
            array (
                'id' => 11,
                'url' => 'about-us',
                'title' => '{"hy":"Մեր մասին","ru":"О нас","en":"About us"}',
                'image' => NULL,
                'show_image' => 1,
                'to_top' => 1,
                'to_menu' => 0,
                'to_footer' => 1,
                'content' => '{"en":null}',
                'title_content' => '{"en":null}',
                'static' => 'about',
                'active' => 1,
                'ordering' => 10,
                'seo_title' => '{"en":null}',
                'seo_description' => '{"en":null}',
                'seo_keywords' => '{"ru":null}',
                'created_at' => '2020-11-18 15:13:33',
                'updated_at' => '2020-11-18 15:49:37',
            ),
            11 =>
            array (
                'id' => 12,
                'url' => 'contacts',
                'title' => '{"hy":"Կոնտակտներ","ru":"Контакты","en":"Contacts"}',
                'image' => NULL,
                'show_image' => 1,
                'to_top' => 1,
                'to_menu' => 0,
                'to_footer' => 1,
                'content' => '{"en":null}',
                'title_content' => '{"en":null}',
                'static' => 'contacts',
                'active' => 1,
                'ordering' => 11,
                'seo_title' => '{"en":null}',
                'seo_description' => '{"en":null}',
                'seo_keywords' => '{"ru":null}',
                'created_at' => '2020-11-18 15:14:46',
                'updated_at' => '2020-11-18 15:49:37',
            ),
        ));


    }
}
