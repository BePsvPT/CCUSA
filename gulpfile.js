process.env.DISABLE_NOTIFIER = true;

const elixir = require('laravel-elixir');

elixir.config.publicPath = 'public/assets';

elixir(function(mix) {
  mix.sass(['app.scss'])
    .scripts(['app.js', 'zinc-analytics.js']);

  mix.browserSync({
    browser: ['google chrome'],
    proxy: 'https://ccusa.dev'
  });
});
