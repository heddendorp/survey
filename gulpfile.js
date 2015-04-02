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

    mix.copy("bower_components/chartist/dist/chartist.min.css","resources/css/chartist.min.css");
    mix.copy("bower_components/chartist/dist/chartist.js","resources/js/chartist.js");
    mix.copy("bower_components/jquery/dist/jquery.js","resources/js/jquery.js");
    mix.copy("semantic/dist/semantic.js","resources/js/semantic.js");
    mix.copy("semantic/dist/semantic.css","resources/css/semantic.css");

    mix.scripts([
        "jquery.js",
        "jquery.restfulizer.js",
        "semantic.js",
        "chartist.js"
    ]);
    mix.styles([
        "chartist.min.css",
        "semantic.css"
    ]);
    mix.version(["css/all.css","js/all.js"]);
});
