<?php

use DaveJamesMiller\Breadcrumbs\Generator;

Breadcrumbs::register('auth.sign-in', function(Generator $generator) {
    $generator->parent('home');

    $generator->push('登入', route('auth.sign-in'));
});
