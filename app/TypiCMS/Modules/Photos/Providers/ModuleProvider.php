<?php
namespace TypiCMS\Modules\Photos\Providers;

use Lang;
use View;
use Config;
use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Application;

// Model
use TypiCMS\Modules\Photos\Models\Photo;

// Repo
use TypiCMS\Modules\Photos\Repositories\EloquentPhoto;

// Cache
use TypiCMS\Modules\Photos\Repositories\CacheDecorator;
use TypiCMS\Services\Cache\LaravelCache;

// Form
use TypiCMS\Modules\Photos\Services\Form\PhotoForm;
use TypiCMS\Modules\Photos\Services\Form\PhotoFormLaravelValidator;

// Observers
use TypiCMS\Observers\PhotoObserver;

class ModuleProvider extends ServiceProvider
{

    public function boot()
    {
        // Bring in the routes
        require __DIR__ . '/../routes.php';

        // Add dirs
        View::addLocation(__DIR__ . '/../Views');
        Lang::addNamespace('photos', __DIR__ . '/../lang');
        Config::addNamespace('photos', __DIR__ . '/../config');

        // Observers
        Photo::observe(new PhotoObserver);
    }

    public function register()
    {

        $app = $this->app;

        /**
         * Sidebar view composer
         */
        $app->view->composer('admin._sidebar', 'TypiCMS\Modules\Photos\Composers\SideBarViewComposer');

        $app->bind('TypiCMS\Modules\Photos\Repositories\PhotoInterface', function (Application $app) {
            $repository = new EloquentPhoto(new Photo);
            if (! Config::get('app.cache')) {
                return $repository;
            }
            $laravelCache = new LaravelCache($app['cache'], ['galleries', 'photos'], 10);

            return new CacheDecorator($repository, $laravelCache);
        });

        $app->bind('TypiCMS\Modules\Photos\Services\Form\PhotoForm', function (Application $app) {
            return new PhotoForm(
                new PhotoFormLaravelValidator($app['validator']),
                $app->make('TypiCMS\Modules\Photos\Repositories\PhotoInterface')
            );
        });

        $app->before(function ($request, $response) {
            require __DIR__ . '/../breadcrumbs.php';
        });

    }
}
