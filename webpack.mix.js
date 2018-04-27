let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css');

// mix.scripts([
// 	'resources/assets/js/jquery.dataTables.min.js',
//     'resources/assets/js/bootstrap-datepicker.min.js',
//     'resources/assets/js/dataTables.bootstrap.min.js'
//     // 'resources/assets/js/jquery.slimscroll.min.js',
//     // 'resources/assets/js/fastclick.js',
//     // 'resources/assets/js/adminlte.min.js',
//     // 'resources/assets/js/demo.js'
// ], 'public/js/dataTables.js')
//     .styles([
//         'resources/assets/css/bootstrap-datepicker.min.css',
//         'resources/assets/css/datepicker3.css',
//         'resources/assets/css/jquery.dataTables.min.css'
//         // 'resources/assets/css/AdminLTE.min.css',
//         // 'resources/assets/css/_all-skins.min.css'
// ], 'public/css/dataTables.css');