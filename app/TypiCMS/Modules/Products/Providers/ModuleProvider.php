<?php
namespace TypiCMS\Modules\Products\Providers;

use Lang;
use View;
use Config;
use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Application;

// Models
use TypiCMS\Modules\Products\Models\Product;
use TypiCMS\Modules\Products\Models\ProductTranslation;

// Repo
use TypiCMS\Modules\Products\Repositories\EloquentProduct;

// Cache
use TypiCMS\Modules\Products\Repositories\CacheDecorator;
use TypiCMS\Services\Cache\LaravelCache;

// Form
use TypiCMS\Modules\Products\Services\Form\ProductForm;
use TypiCMS\Modules\Products\Services\Form\ProductFormLaravelValidator;

// Observers
use TypiCMS\Observers\SlugObserver;
use TypiCMS\Observers\FileObserver;

class ModuleProvider extends ServiceProvider
{

    public function boot()
    {
        // Bring in the routes
        require __DIR__ . '/../routes.php';

        // Add dirs
        View::addLocation(__DIR__ . '/../Views');
        Lang::addNamespace('products', __DIR__ . '/../lang');
        Config::addNamespace('products', __DIR__ . '/../config');

        // Observers
        ProductTranslation::observe(new SlugObserver);
        Product::observe(new FileObserver);
    }

    public function register()
    {

        $app = $this->app;

        /**
         * Sidebar view composer
         */
        $app->view->composer('admin._sidebar', 'TypiCMS\Modules\Products\Composers\SideBarViewComposer');

        $app->bind('TypiCMS\Modules\Products\Repositories\ProductInterface', function (Application $app) {
            $repository = new EloquentProduct(
                new Product,
                $app->make('TypiCMS\Modules\Tags\Repositories\TagInterface')
            );
            if (! Config::get('app.cache')) {
                return $repository;
            }
            $laravelCache = new LaravelCache($app['cache'], ['products', 'tags', 'photos'], 10);

            return new CacheDecorator($repository, $laravelCache);
        });

        $app->bind('TypiCMS\Modules\Products\Services\Form\ProductForm', function (Application $app) {
            return new ProductForm(
                new ProductFormLaravelValidator($app['validator']),
                $app->make('TypiCMS\Modules\Products\Repositories\ProductInterface')
            );
        });

        $app->before(function ($request, $response) {
            require __DIR__ . '/../breadcrumbs.php';
        });

    }
}
