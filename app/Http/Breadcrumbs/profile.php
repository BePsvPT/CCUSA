<?php

use DaveJamesMiller\Breadcrumbs\Generator;

Breadcrumbs::register('profile.index', function (Generator $generator) {
    $generator->parent('home');

    $generator->push('簡介', route('profile.index'));
});
