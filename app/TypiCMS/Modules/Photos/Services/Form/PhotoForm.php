<?php
namespace TypiCMS\Modules\Photos\Services\Form;

use TypiCMS\Services\Form\AbstractForm;
use TypiCMS\Services\Validation\ValidableInterface;
use TypiCMS\Modules\Photos\Repositories\PhotoInterface;

class PhotoForm extends AbstractForm
{

    public function __construct(ValidableInterface $validator, PhotoInterface $photo)
    {
        $this->validator = $validator;
        $this->repository = $photo;
    }
}
