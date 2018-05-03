<?php

use DaveJamesMiller\Breadcrumbs\Generator;

Breadcrumbs::register('cooperative-stores.index', function (Generator $generator) {
    $generator->parent('home');

    $generator->push('特約商店', route('cooperative-stores.index'));
});

Breadcrumbs::register('cooperative-stores.manage', function (Generator $generator) {
    $generator->parent('cooperative-stores.index');

    $generator->push('管理', route('cooperative-stores.manage'));
});

Breadcrumbs::register('cooperative-stores.show', function (Generator $generator, $cs) {
    $generator->parent('cooperative-stores.index');

    $name = urldecode(array_first(explode('-', $cs)));
    $generator->push($name, route('cooperative-stores.show', ['cs' => $cs]));
});

Breadcrumbs::register('cooperative-stores.create', function (Generator $generator) {
    $generator->parent('cooperative-stores.manage');

    $generator->push('新增', route('cooperative-stores.create'));
});

Breadcrumbs::register('cooperative-stores.edit', function (Generator $generator, $cs) {
    $generator->parent('cooperative-stores.manage');

    $generator->push('編輯', route('cooperative-stores.edit', ['cs' => $cs]));
});

Breadcrumbs::register('cooperative-stores.profile', function (Generator $generator, $cs) {
    $generator->parent('cooperative-stores.index');

    $generator->push('簡介', route('cooperative-stores.profile', ['cs' => $cs]));
});
