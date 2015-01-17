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
    
    
    /**
     * Get models
     * 
     * @return Response
     */	
    public function index()
    {
	    $models=$this->repository->getCategoriesForList();
        //$models = $this->repository->getAll([], true);
        /*
foreach($models as $model)
        {
	        
		    echo "<br/>".$model->title;
		    
	    }
*/
        return Response::json($models, 200);
    }
}
