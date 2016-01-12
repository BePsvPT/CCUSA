require('dotenv').load();

if ('true' === process.env.DISABLE_GULP_NOTIFY) {
    process.env.DISABLE_NOTIFIER = true;
}

var elixir = require('laravel-elixir');

elixir.config.publicPath = 'public/assets';

elixir(function(mix) {
    mix.sass(['app.scss'])
       .scripts(['app.js', 'zinc-analytics.js']);

    if ('true' === process.env.BROWSER_SYNC) {
        mix.browserSync({
            proxy: 'localhost:8000'
        });
    }

    if ('true' === process.env.PHP_UNIT) {
        mix.phpUnit();
    }
});
