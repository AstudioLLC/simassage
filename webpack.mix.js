const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss');
/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/script.js', 'public/js')
    .js('resources/js/home.js', 'public/js')
    .js('resources/js/auth.js', 'public/js')
    .js('resources/js/detail.js', 'public/js')
    .js('resources/js/product.js', 'public/js')
    .js('resources/js/cabinet.js', 'public/js')
    .js('resources/js/info.js', 'public/js')
    .js('resources/js/viewModel-bundle.js', 'public/js')
    .js('resources/js/basket-bundle.js', 'public/js')
    .js('resources/js/basket-calculator.js', 'public/js')
    .sass('resources/css/cms/auth.scss', 'public/css')
    .sass('resources/css/cms/main.scss', 'public/cms/css')
    .sass('resources/css/app.scss', 'public/css')
    .sass('resources/css/home.scss', 'public/css')
    .sass('resources/css/info.scss', 'public/css')
    .sass('resources/css/media.scss', 'public/css')
    .sass('resources/css/cabinet.scss', 'public/css')
    .sass('resources/css/auth.scss', 'public/css')
    .sass('resources/css/product.scss', 'public/css')
    .sass('resources/css/product-detail.scss', 'public/cms/css')


    .sass('resources/css/slider.scss', 'public/css')

    .js('resources/js/slider.js', 'public/js')

    .options({
        processCssUrls: false,
        postCss: [
            tailwindcss('./tailwind.config.js'),
        ]
    }).disableNotifications();
