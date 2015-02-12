<?php
namespace TypiCMS\Modules\Categories\Controllers;


use Input;
use Redirect;
use View;
use Illuminate\Database\Eloquent\Model;
use TypiCMS\Controllers\AdminSimpleController;
use TypiCMS\Modules\Categories\Repositories\CategoryInterface;
use TypiCMS\Modules\Categories\Services\Form\CategoryForm;

class AdminController extends AdminSimpleController
{
    
    public function __construct(CategoryInterface $category, CategoryForm $categoryform)
    {
        parent::__construct($category, $categoryform);
        $this->title['parent'] = trans_choice('categories::global.categories', 2);
    }
    
	/**
     * Show the form for creating a new resource.
     *
     * @return void
     */
	public function create()
    {
        $model = $this->repository->getModel();
		
        $this->layout->content = View::make('admin.create')
            ->withModel($model);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  Model    $model
     * @return Redirect
     */
    public function store()
    {
	
		$input = Input::all();
		if($input['parent_id']==0)
		{
			$input['parent_id']=null;
		}
		
        if ($model = $this->form->save($input)) {
            $redirectUrl = Input::get('exit') ? $model->indexUrl() : $model->editUrl() ;
            return Redirect::to($redirectUrl);
        }

        return Redirect::route('admin.' . $this->repository->getTable() . '.create')
            ->withInput()
            ->withErrors($this->form->errors());

    }
    
    
    /**
     * Update the specified resource in storage.
     *
     * @param  Model    $model
     * @return Redirect
     */
    public function update(Model $model)
    {
		$input = Input::all();
		if($input['parent_id']==0)
		{
			$input['parent_id']=null;
		}
        if ($this->form->update($input)) {
            $redirectUrl = Input::get('exit') ? $model->indexUrl() : $model->editUrl() ;
            return Redirect::to($redirectUrl);
        }

        return Redirect::to($model->editUrl())
            ->withInput()
            ->withErrors($this->form->errors());

    }

    /**
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  Model $model
     * @return void
     */
    public function edit(Model $model)
    {
        $this->layout->content = View::make('admin.edit')
            ->withModel($model);
    }
}
