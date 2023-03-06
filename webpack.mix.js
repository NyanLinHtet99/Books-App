const mix = require("laravel-mix");

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

mix.js("resources/js/app.js", "public/js")
    .js("resources/assets/jqwidgets/jqx-all.js", "public/js")
    .js("resources/assets/jqwidgets/jqxcore.js", "public/js")
    .sass("resources/sass/app.scss", "public/css")
    .postCss("resources/assets/jqwidgets/styles/jqx.base.css", "public/css")
    .postCss("resources/assets/jqwidgets/styles/jqx.light.css", "public/css")
    .sourceMaps();
