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

mix.js('resources/assets/js/app.js', 'public/js');
   .sass('resources/assets/sass/app.scss', 'public/css');

// mix.scripts([
//     'resources/assets/js/fullcalendar.min.js,',
// 	'resources/assets/js/moment.js',
//     'resources/assets/js/jquery-ui.min.js'
//     // 'resources/assets/js/buttons.flash.min.js',
//     // 'resources/assets/js/jszip.min.js',
//     // 'resources/assets/js/pdfmake.min.js',
//     // 'resources/assets/js/vfs_fonts.js',
//     // 'resources/assets/js/buttons.html5.min.js',
//     // 'resources/assets/js/buttons.print.min.js'
//     // 'resources/assets/js/demo.js'
// ], 'public/js/calendar.js')
//     .styles([
//         'resources/assets/css/fullcalendar.min.css',
//         'resources/assets/css/fullcalendar.print.min.css'
//         // 'resources/assets/css/icons.css'
//         // 'resources/assets/css/AdminLTE.min.css',
//         // 'resources/assets/css/_all-skins.min.css'
// ], 'public/css/calendar.css');