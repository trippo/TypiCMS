<?php

// Products

Breadcrumbs::register('admin.products.index', function (\DaveJamesMiller\Breadcrumbs\Generator $breadcrumbs) {
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push(Str::title(trans('products::global.name')), route('admin.products.index'));
});

Breadcrumbs::register('admin.products.edit', function (
        \DaveJamesMiller\Breadcrumbs\Generator $breadcrumbs,
        \TypiCMS\Modules\Products\Models\Product $product
    ) {
    $breadcrumbs->parent('admin.products.index');
    $breadcrumbs->push($product->title, route('admin.products.edit', $product->id));
});

Breadcrumbs::register('admin.products.create', function (\DaveJamesMiller\Breadcrumbs\Generator $breadcrumbs) {
    $breadcrumbs->parent('admin.products.index');
    $breadcrumbs->push(trans('products::global.New'), route('admin.products.create'));
});
