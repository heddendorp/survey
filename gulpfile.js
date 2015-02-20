var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.copy("bower_components/uikit/scss","resources/assets/sass/uikit");
    mix.copy("bower_components/uikit/js","resources/js");
    mix.copy("bower_components/jquery/dist/jquery.js","resources/js/jquery.js");
    mix.copy("bower_components/uikit/fonts","public/fonts");
    mix.scripts([
        "jquery.js",
        "uikit.js",
        "components/sortable.js",
        "jquery.restfulizer.js",
        "app.js"
    ]);
    mix.sass('app.sass');
    mix.version(["css/app.css","js/all.js"]);
});
