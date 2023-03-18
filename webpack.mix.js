import { js } from 'laravel-mix';

js(['resources/js/app.js',
    'resources/js/scripts/localidades/localidade.js',
],'public/js' )
    .vue()
    .sass('resources/sass/app.scss', 'public/css');



