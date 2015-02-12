<?php
Route::bind('products', function ($value) {
    return TypiCMS\Modules\Products\Models\Product::where('id', $value)
        ->with('translations')
        ->firstOrFail();
});

if (! App::runningInConsole()) {
    Route::group(
        array(
            'before'    => 'visitor.publicAccess',
            'namespace' => 'TypiCMS\Modules\Products\Controllers',
        ),
        function () {
            $routes = app('TypiCMS.routes');
            foreach (Config::get('app.locales') as $lang) {
                if (isset($routes['products'][$lang])) {
                    $uri = $routes['products'][$lang];
                } else {
                    $uri = 'products';
                    if (Config::get('app.fallback_locale') != $lang || Config::get('app.main_locale_in_url')) {
                        $uri = $lang . '/' . $uri;
                    }
                }
                Route::get(
                    $uri,
                    array('as' => $lang.'.products', 'uses' => 'PublicController@index')
                );
                Route::get(
                    $uri.'/{categories}',
                    array('as' => $lang.'.products.categories', 'uses' => 'PublicController@index')
                );
                Route::get(
                    $uri.'/{categories}/{slug}',
                    array('as' => $lang.'.products.categories.slug', 'uses' => 'PublicController@show')
                );
            }
        }
    );
}

Route::group(
    array(
        'namespace' => 'TypiCMS\Modules\Products\Controllers',
        'prefix'    => 'admin',
    ),
    function () {
        Route::resource('products', 'AdminController');
        Route::post('products/sort', array('as' => 'admin.products.sort', 'uses' => 'AdminController@sort'));
    }
);

Route::group(array('prefix'=>'api/v1'), function() {
    Route::resource(
        'products',
        'TypiCMS\Modules\Products\Controllers\ApiController'
    );
});
