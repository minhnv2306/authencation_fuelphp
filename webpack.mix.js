const { mix } = require('laravel-mix');

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

mix
    .styles([
        'node_modules/bootstrap/dist/css/bootstrap.min.css',
    ], 'public/assets/css/vendor.css')
    .styles([
        'node_modules/toastr/build/toastr.css'
    ], 'public/assets/css/toastr.css')
    .styles([
        'node_modules/bootstrap/dist/css/bootstrap.css'
    ], 'public/assets/css/bootstrap.css')
    .copy([
        'node_modules/toastr/build/toastr.min.js'
    ], 'public/assets/js/toastr.min.js')
    .copy([
        'node_modules/jquery/dist/jquery.js'
    ], 'public/assets/js/jquery.js')
    .copy([
        'node_modules/bootstrap/dist/js/bootstrap.js'
    ], 'public/assets/js/bootstrap.js');