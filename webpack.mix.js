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
	.js('resources/assets/js/libraries.js', 'public/js')
  .sass('resources/assets/sass/app.scss', 'public/css')
  .scripts([
	'resources/assets/js/main.js',
	'resources/assets/js/utils.js',
  ], 'public/js/scripts.js')
  .scripts([
  	'resources/assets/js/user.js'
  	], 'public/js/normal_user.js');

mix.browserSync('localhost:8000');