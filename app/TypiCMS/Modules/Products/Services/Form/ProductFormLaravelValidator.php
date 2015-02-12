<?php
namespace TypiCMS\Modules\Products\Services\Form;

use TypiCMS\Services\Validation\AbstractLaravelValidator;

class ProductFormLaravelValidator extends AbstractLaravelValidator
{

    /**
     * Validation rules
     *
     * @var Array
     */
    protected $rules = array(
        'fr.slug'     => 'required_with:fr.title|required_if:fr.status,1|alpha_dash',
        'it.slug'     => 'required_with:it.title|required_if:it.status,1|alpha_dash',
        'es.slug'     => 'required_with:es.title|required_if:es.status,1|alpha_dash',
        'nl.slug'     => 'required_with:nl.title|required_if:nl.status,1|alpha_dash',
        'en.slug'     => 'required_with:en.title|required_if:en.status,1|alpha_dash',
        'category_id' => 'required',
    );
}
