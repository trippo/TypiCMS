<?php
namespace TypiCMS\Modules\Photos\Services\Form;

use TypiCMS\Services\Validation\AbstractLaravelValidator;

class PhotoFormLaravelValidator extends AbstractLaravelValidator
{

    /**
     * Validation rules
     *
     * @var Array
     */
    protected $rules = array(
        'photo' => 'mimes:jpeg,gif,png|max:2000',
    );
}
