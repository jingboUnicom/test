const mix = require("laravel-mix");

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

mix.options({
    processCssUrls: false,
    postCss: [require("tailwindcss"), require("autoprefixer")],
});

mix.setPublicPath('public');

// mix.js("resources/js/app.js", "public/js").postCss(
//     "resources/css/app.css",
//     "public/css",
//     [require("postcss-import"), require("tailwindcss")]
// );

mix.sass('resources/sass/app.scss', 'css');
mix.sass('resources/sass/filament.scss', 'css');
mix.sass('resources/sass/content.scss', 'css');

mix.js('resources/js/app.js', 'js');
mix.js('resources/js/alpine.js', 'js');

if (mix.inProduction()) {
    mix.version();
}

mix.disableNotifications();
// mix.disableSuccessNotifications();
