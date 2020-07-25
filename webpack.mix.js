const mix = require('laravel-mix');
const minifier = require('minifier');

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
/*
mix.setPublicPath('../public_html/big-shop');
*/
/*
const base = '../public_html/big-shop/';
*/
mix.webpackConfig({
    resolve: {
        alias: {
            'vue$': 'vue/dist/vue.esm.js'
        }
    }
});

mix.options({
    processCssUrls: false,
    purifyCss: true,
});

mix
    .js('resources/assets/js/bootstrap.js', 'js/bootstrap.js')
    .js('resources/assets/js/app.js', 'js/app.js')
    .sass('resources/assets/sass/app.scss', 'css/app.css')
    .sass('resources/assets/sass/styles.scss', 'css/styles1.css');

mix.extract();
/*mix.then(() => {
	minifier.minify(base+'js/app.js');
  minifier.minify(base+'css/app.css');
  minifier.minify(base+'css/styles1.css');
});*/
/*
mix.styles('public/css/pages/home.css', 'public/css/pages/homePreFixed.css')
	.options({
		postCss: [
			require('autoprefixer')({
				browsers: ['last 40 versions'],
				grid: true
			})
		]
});*/
