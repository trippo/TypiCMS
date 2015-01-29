<?php
namespace TypiCMS\Modules\Categories\Controllers;

use TypiCMS\Controllers\BaseApiController;
use TypiCMS\Modules\Categories\Repositories\CategoryInterface as Repository;
use Input;
use Response;

class ApiController extends BaseApiController
{
    public function __construct(Repository $repository)
    {
        parent::__construct($repository);
    }
    
    private function recursive_list(){
	    
    }
    /**
     * Get models
     * 
     * @return Response
     */	
    public function index()
    {
	    $models=$this->repository->getCategoriesForList();
	    
        return Response::json($models, 200);
    }
}
