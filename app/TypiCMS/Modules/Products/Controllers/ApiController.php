<?php
namespace TypiCMS\Modules\Products\Controllers;

use TypiCMS\Controllers\BaseApiController;
use TypiCMS\Modules\Products\Repositories\ProductInterface as Repository;

class ApiController extends BaseApiController
{
    public function __construct(Repository $repository)
    {
        parent::__construct($repository);
    }
}
