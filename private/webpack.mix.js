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

mix.styles([
    'resources/css/bootstrap.css',
    'resources/css/bootstrap-datetimepicker.min.css',
    'resources/css/font-awesome.css',
    'resources/css/sb-admin-2.css',
    'resources/css/timeline.css',
    'resources/css/custom-style.css',
    'resources/css/dataTables.min.css'], 'public/assets/stylesheets/styles.css', './');
mix.scripts([
    'resources/js/jquery.js',
    'resources/js/jquery.validate.min.js',
    'resources/js/additional-methods.min.js',
    'resources/js/dataTables.min.js',
    'resources/js/bootstrap.js',
    'resources/js/bootstrap-datetimepicker.min.js',
    'resources/js/formtowizard.js',
    'resources/js/common_admin.js',
    'resources/js/Chart.js',
    'resources/js/metisMenu.js',
    'resources/js/sb-admin-2.js',
    'resources/js/frontend.js',
], 'public/assets/scripts/frontend.js', './');

