<?php

// Menus

Breadcrumbs::register('admin.menus.index', function($breadcrumbs) {
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push(Str::title(trans_choice('modules.menus.menus', 2)), route('admin.menus.index'));
});

Breadcrumbs::register('admin.menus.edit', function($breadcrumbs, $menu) {
    $breadcrumbs->parent('admin.menus.index');
    $breadcrumbs->push($menu->title, route('admin.menus.edit', $menu->id));
});

Breadcrumbs::register('admin.menus.create', function($breadcrumbs) {
    $breadcrumbs->parent('admin.menus.index');
    $breadcrumbs->push(trans('modules.menus.New'), route('admin.menus.create'));
});