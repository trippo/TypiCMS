<?php
namespace TypiCMS\Modules\Products\Services\Form;

use TypiCMS\Services\Form\AbstractForm;
use TypiCMS\Services\Validation\ValidableInterface;
use TypiCMS\Modules\Products\Repositories\ProductInterface;

class ProductForm extends AbstractForm
{

    public function __construct(ValidableInterface $validator, ProductInterface $product)
    {
        $this->validator = $validator;
        $this->repository = $product;
    }
}
