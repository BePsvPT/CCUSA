<?php

use DaveJamesMiller\Breadcrumbs\Generator;

Breadcrumbs::register('home', function(Generator $generator)
{
    $generator->push('Home', route('home'), [
        'img' => asset('assets/media/images/general/logo/banner.png'),
        'notitle' => true,
    ]);
});

foreach (File::files(app_path('Http/Breadcrumbs')) as $path) {
    require_once $path;
}
