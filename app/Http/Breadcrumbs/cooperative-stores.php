<?php

use DaveJamesMiller\Breadcrumbs\Generator;

Breadcrumbs::register('cooperative-stores.index', function (Generator $generator) {
    $generator->parent('home');

    $generator->push('特約商店', route('cooperative-stores.index'));
});

Breadcrumbs::register('cooperative-stores.create', function (Generator $generator) {
    $generator->parent('cooperative-stores.index');

    $generator->push('新增', route('cooperative-stores.create'));
});

Breadcrumbs::register('cooperative-stores.edit', function (Generator $generator, $cs) {
    $generator->parent('cooperative-stores.index');

    $generator->push('編輯', route('cooperative-stores.edit', ['cs' => $cs]));
});
