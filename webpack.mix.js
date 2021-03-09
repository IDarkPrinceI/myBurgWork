const mix = require('laravel-mix');

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

//far
mix.styles([
    'resources/assets/far/plugins/fontawesome-free/css/all.min.css',
    'resources/assets/far/css/adminlte.min.css',
    'resources/assets/far/css/jquery-ui.min.css',
    'resources/assets/far/css/Chart.css',
], 'public/assets/far/css/far.css');

mix.scripts([
    'resources/assets/far/plugins/jquery/jquery.min.js',
    'resources/assets/far/plugins/bootstrap/js/bootstrap.bundle.min.js',
    'resources/assets/far/js/adminlte.min.js',
    'resources/assets/far/js/demo.js',
    'resources/assets/far/js/jquery.ui.datepicker-ru.js',
    'resources/assets/far/js/jquery-ui.min.js',
    'resources/assets/far/js/Chart.js',
    'resources/assets/far/js/myChart.js',
], 'public/assets/far/js/far.js');

mix.copyDirectory('resources/assets/far/plugins/fontawesome-free/webfonts', 'public/assets/far/webfonts');
mix.copyDirectory('resources/assets/far/img', 'public/assets/far/img');

mix.copyDirectory('resources/assets/far/css/images', 'public/assets/far/css/images')

mix.copy('resources/assets/far/css/adminlte.min.css.map', 'public/assets/far/css/adminlte.min.css.map');
mix.copy('resources/assets/far/js/adminlte.min.js.map', 'public/assets/far/js/adminlte.min.js.map');
mix.copy('resources/assets/far/js/main.js', 'public/assets/far/js/main.js');

//front
mix.styles([
    'resources/assets/front/css/animate.css',
    'resources/assets/front/css/bootstrap.min.css',
    'resources/assets/front/css/flaticon.css',
    'resources/assets/front/css/font-awesome.min.css',
    'resources/assets/front/css/jquery-ui.css',
    'resources/assets/front/css/magnific-popup.css',
    'resources/assets/front/css/nice-select.css',
    'resources/assets/front/css/owl.carousel.min.css',
    'resources/assets/front/css/slicknav.css',
    'resources/assets/front/css/style.css',
    'resources/assets/front/css/theme-default.css',
    'resources/assets/front/css/themify-icons.css',
], 'public/assets/front/css/front.css');

mix.scripts([
    'resources/assets/front/js/vendor/jquery-1.12.4.min.js',
], 'public/assets/front/js/front.js');

mix.copy('resources/assets/front/js/mainFront.js', 'public/assets/front/js/mainFront.js');

mix.copyDirectory('resources/assets/front/fonts', 'public/assets/front/fonts');

mix.copyDirectory('resources/assets/front/img', 'public/assets/front/img');

mix.copy('resources/assets/front/css/style.map', 'public/assets/front/css/style.map');
mix.copy('resources/assets/front/css/theme-default.map', 'public/assets/front/css/theme-default.map');
