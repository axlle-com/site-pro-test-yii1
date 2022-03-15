const mix = require('laravel-mix');

mix.styles([
    'resources/frontend/plugins/bootstrap/css/bootstrap.css',
    'resources/frontend/css/main.css',
    'resources/frontend/css/common.css',
], 'assets/frontend/css/main.min.css');
mix.js('resources/frontend/js/app.js','assets/frontend/js/').extract(['jquery', 'bootstrap',]);
mix.scripts([
    'resources/frontend/js/common.js',
], 'assets/frontend/js/main.min.js');
mix.copy('resources/frontend/images', 'assets/frontend/images');
