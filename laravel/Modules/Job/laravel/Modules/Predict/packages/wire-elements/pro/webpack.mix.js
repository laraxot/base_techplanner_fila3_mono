const mix = require('laravel-mix');

mix.js('resources/js/overlay-component.js', 'resources/dist/js/')
    .postCss("resources/css/bootstrap/overlay-component.css", "resources/dist/css/bootstrap-overlay-component.css");

mix.js('resources/js/insert-component.js', 'resources/dist/js/')
    .postCss("resources/css/bootstrap/insert-component.css", "resources/dist/css/bootstrap-insert-component.css");

mix.js('resources/js/spotlight-component.js', 'resources/dist/js/')
    .postCss("resources/css/bootstrap/spotlight-component.css", "resources/dist/css/bootstrap-spotlight-component.css");
