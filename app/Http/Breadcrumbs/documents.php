<?php

use DaveJamesMiller\Breadcrumbs\Generator;

Breadcrumbs::register('documents.index', function(Generator $generator)
{
    $generator->parent('home');

    $generator->push('文件', route('documents.index'));
});

Breadcrumbs::register('documents.create', function(Generator $generator)
{
    $generator->parent('documents.index');

    $generator->push('新增', route('documents.create'));
});

Breadcrumbs::register('documents.edit', function(Generator $generator, $hashid)
{
    $generator->parent('documents.index');

    $generator->push('編輯', route('documents.edit', ['hashid' => $hashid]));
});
