<?php
namespace TypiCMS\Modules\Photos\Controllers;

use Config;
use Input;
use Paginator;
use TypiCMS\Controllers\AdminSimpleController;
use TypiCMS\Modules\Photos\Repositories\PhotoInterface;
use TypiCMS\Modules\Photos\Services\Form\PhotoForm;
use Illuminate\Database\Eloquent\Model;
use Redirect;
use View;

class AdminController extends AdminSimpleController
{

    public function __construct(PhotoInterface $photo, PhotoForm $photoform)
    {
        parent::__construct($photo, $photoform);
        $this->title['parent'] = trans_choice('photos::global.photos', 2);
    }

    /**
     * List files
     * @return response views
     */
    public function index()
    {
        $page       = Input::get('page');
        $type       = Input::get('type');
        $product_id = Input::get('product_id');
        $view       = Input::get('view');
        if ($view != 'filepicker') {
            return parent::index();
        }

        $itemsPerPage = Config::get('photos::admin.itemsPerPage');

        $data = $this->repository->byPageFrom($page, $itemsPerPage, $product_id, array('translations'), true, $type);

        $models = Paginator::make($data->items, $data->totalItems, $itemsPerPage);

        $this->layout->content = View::make('photos.admin.' . $view)
            ->withModels($models);
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  Model    $model
     * @return Redirect
     */
    public function update(Model $model)
    {

        if ($this->form->update(Input::all())) {
            $redirectUrl = Input::get('exit') ? $model->returnUrl() : $model->editUrl() ;
            return Redirect::to($redirectUrl);
        }

        return Redirect::to($model->editUrl())
            ->withInput()
            ->withErrors($this->form->errors());

    }
    
}
