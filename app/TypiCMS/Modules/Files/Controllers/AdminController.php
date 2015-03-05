<?php
namespace TypiCMS\Modules\Files\Controllers;

use Config;
use Input;
use Paginator;
use TypiCMS\Controllers\AdminSimpleController;
use TypiCMS\Modules\Files\Repositories\FileInterface;
use TypiCMS\Modules\Files\Services\Form\FileForm;
use Illuminate\Database\Eloquent\Model;
use Redirect;
use View;

class AdminController extends AdminSimpleController
{

    public function __construct(FileInterface $file, FileForm $fileform)
    {
        parent::__construct($file, $fileform);
        $this->title['parent'] = trans_choice('files::global.files', 2);
    }

    /**
     * List files
     * @return response views
     */
    public function index()
    {
        $page       = Input::get('page');
        $type       = Input::get('type');
        $gallery_id = Input::get('gallery_id');
        $view       = Input::get('view');
        if ($view != 'filepicker') {
            return parent::index();
        }

        $itemsPerPage = Config::get('files::admin.itemsPerPage');

        $data = $this->repository->byPageFrom($page, $itemsPerPage, $gallery_id, array('translations'), true, $type);

        $models = Paginator::make($data->items, $data->totalItems, $itemsPerPage);

        $this->layout->content = View::make('files.admin.' . $view)
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
