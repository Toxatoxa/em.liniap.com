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

mix.js([
    'resources/assets/js/app.js',
    'resources/assets/js/bootstrap-tagsinput.js',
    'resources/assets/js/notify.min.js',
    'resources/assets/js/pusher.min.js',
    // 'node_modules/tinymce/tinymce.js'
    // 'resources/assets/js/tinymce.min.js'
], 'public/js/app.js')
    .sass('resources/assets/sass/app.scss', 'public/css')
    .styles([
        'resources/assets/css/bootstrap-tagsinput.css',
        'resources/assets/css/custom.css',
        'resources/assets/css/hint.min.css'
    ], 'public/css/all.css')
    .version();