<?php
namespace TypiCMS\Modules\Photos\Controllers;

use Input;
use TypiCMS\Controllers\BaseApiController;
use TypiCMS\Modules\Photos\Repositories\PhotoInterface as Repository;
use Response;

class ApiController extends BaseApiController
{
    public function __construct(Repository $repository)
    {
        parent::__construct($repository);
    }

    /**
     * Get models
     * @return Response
     */
    public function index()
    {
        if ($product_id = Input::get('product_id', 0)) {
            $models = $this->repository->getAllBy('product_id', $product_id, [], true);
        } else {
            $models = $this->repository->getAll([], true);
        }
        return Response::json($models, 200);
    }
}
