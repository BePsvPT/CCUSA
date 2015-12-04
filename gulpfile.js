require('dotenv').load();

if ('true' === process.env.DISABLE_GULP_NOTIFY) {
    process.env.DISABLE_NOTIFIER = true;
}

var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.sass([
        'app.scss'
    ], 'public/assets/css');

    mix.scripts([
        'app.js'
    ], 'public/assets/js');

    if ('true' === process.env.BROWSER_SYNC) {
        mix.browserSync({
            proxy: 'localhost:8000'
        });
    }

    if ('true' === process.env.PHP_UNIT) {
        mix.phpUnit();
    }
});
