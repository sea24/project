let mix = require('laravel-mix');

mix.js('resources/assets/js/app.js', 'public/js');
mix.sass('resources/assets/sass/app.scss', 'public/css').version();
mix.browserSync('http://www.bottomlayer.com');
