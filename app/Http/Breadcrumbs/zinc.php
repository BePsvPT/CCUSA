<?php

use DaveJamesMiller\Breadcrumbs\Generator;

Breadcrumbs::register('zinc.index', function (Generator $generator) {
    $generator->parent('home');

    $generator->push('會刊', route('zinc.index'));
});

Breadcrumbs::register('zinc.manage', function (Generator $generator) {
    $generator->parent('zinc.index');

    $generator->push('管理', route('zinc.manage'));
});

Breadcrumbs::register('zinc.create', function (Generator $generator) {
    $generator->parent('zinc.manage');

    $generator->push('新增', route('zinc.create'));
});

Breadcrumbs::register('zinc.edit', function (Generator $generator, $id) {
    $generator->parent('zinc.manage');

    $generator->push('編輯', route('zinc.edit', ['zinc' => $id]));
});
