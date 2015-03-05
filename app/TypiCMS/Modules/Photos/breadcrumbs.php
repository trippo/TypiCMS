<?php

// Photos

Breadcrumbs::register('admin.photos.index', function (\DaveJamesMiller\Breadcrumbs\Generator $breadcrumbs) {
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push(Str::title(trans('photos::global.name')), route('admin.photos.index'));
});

// Photos linked to modules
$modulesWithPhotos = array('pages', 'events', 'news', 'projects', 'products');

foreach ($modulesWithPhotos as $module) {

    Breadcrumbs::register('admin.' . $module . '.photos.index', function (
            \DaveJamesMiller\Breadcrumbs\Generator $breadcrumbs,
            \TypiCMS\Modules\Photos\Models\Photo $model
        ) use ($module) {
        $breadcrumbs->parent('admin.' . $module . '.edit', $model);
        $breadcrumbs->push(
            Str::title(trans_choice('photos::global.photos', 2)),
            route('admin.' . $module . '.photos.index', $model->id)
        );
    });

    Breadcrumbs::register('admin.' . $module . '.photos.edit', function (
            \DaveJamesMiller\Breadcrumbs\Generator $breadcrumbs,
            $model,
            \TypiCMS\Modules\Photos\Models\Photo $photo
        ) use ($module) {
        $breadcrumbs->parent('admin.' . $module . '.photos.index', $model);
        $breadcrumbs->push($photo->filename, route('admin.' . $module . '.index'));
    });

    Breadcrumbs::register('admin.' . $module . '.photos.create', function (\DaveJamesMiller\Breadcrumbs\Generator $breadcrumbs, $model) use ($module) {
        $breadcrumbs->parent('admin.' . $module . '.photos.index', $model);
        $breadcrumbs->push(trans('photos::global.New'), route('admin.' . $module . '.index'));
    });

}
