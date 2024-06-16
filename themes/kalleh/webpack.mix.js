const mix = require('laravel-mix');
mix.js('resources/js/app.js', 'public/js/app.js');
mix.sass('resources/sass/custom.scss', 'public/css/style.css', {}, [
        require("rtlcss")({}),
    ])
    .options({
        processCssUrls: true,
    });

mix.webpackConfig({
    stats: {
        children: true,
    },
});
