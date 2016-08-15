<?php

use DaveJamesMiller\Breadcrumbs\Generator;

Breadcrumbs::register('zinc.index', function(Generator $generator)
{
    $generator->parent('home');

    $generator->push('會刊', route('zinc.index'));
});

Breadcrumbs::register('zinc.manage.index', function(Generator $generator)
{
    $generator->parent('zinc.index');

    $generator->push('管理', route('zinc.manage.index'));
});

Breadcrumbs::register('zinc.manage.analytics', function(Generator $generator)
{
    $generator->parent('zinc.manage.index');

    $generator->push('流量分析', route('zinc.manage.analytics'));
});

Breadcrumbs::register('zinc.manage.create', function(Generator $generator)
{
    $generator->parent('zinc.manage.index');

    $generator->push('新增', route('zinc.manage.create'));
});

Breadcrumbs::register('zinc.manage.edit', function(Generator $generator, $id)
{
    $generator->parent('zinc.manage.index');

    $generator->push('編輯', route('zinc.manage.edit', ['manage' => $id]));
});
