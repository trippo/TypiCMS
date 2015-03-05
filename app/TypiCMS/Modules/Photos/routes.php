<?php
Route::bind('photos', function ($value) {
    return TypiCMS\Modules\Photos\Models\Photo::where('id', $value)
        ->with('translations')
        ->firstOrFail();
});

Route::group(
    array(
        'namespace' => 'TypiCMS\Modules\Photos\Controllers',
        'prefix'    => 'admin',
    ),
    function () {
        Route::resource('photos', 'AdminController');
        Route::post('photos/sort', array( 'as' => 'admin.photos.sort', 'uses' => 'AdminController@sort'));
        Route::post('photos/upload', array( 'as' => 'admin.photos.upload', 'uses' => 'AdminController@upload'));
    }
);

Route::group(array('prefix'=>'api'), function() {
    Route::resource(
        'photos',
        'TypiCMS\Modules\Photos\Controllers\ApiController'
    );
});
