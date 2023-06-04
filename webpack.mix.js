import mix from 'laravel-mix';

mix.setPublicPath('public');

mix.js(['resources/js/app.js',
    'resources/js/scripts/localidades/localidade.js',
],'public/js' )
    .vue()
    .sass('resources/sass/app.scss', 'public/css');



