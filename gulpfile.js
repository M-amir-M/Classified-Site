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
    mix.sass('app.scss')
        .scripts([
            'sweetalert.js',
            'dropzone.js',
            'material.min.js',
            'nouislider.min.js',
            'material-kit.js',
            'bootstrap-select.min.js',
        ])
        .styles([
            'hover.css',
            'sweetalert.css',
            'dropzone.css',
            'material-kit.css',
            'bootstrap-select.min.css'
        ]);
});
