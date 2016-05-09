process.env.DISABLE_NOTIFIER = true;

var elixir = require('laravel-elixir');

elixir.config.publicPath = 'public/assets';

elixir(function(mix) {
  mix.sass(['app.scss'])
    .scripts(['app.js', 'zinc-analytics.js']);

  mix.browserSync({
    proxy: 'ccusa.dev'
  });
});
