<?php
namespace TypiCMS\Modules\Products\Presenters;

use TypiCMS\Presenters\Presenter;

class ModulePresenter extends Presenter
{


    /**
    * Photos in list
    *
    * @return string
    */
    public function countPhotos()
    {
        $nbPhotos = $this->entity->photos->count();
        $label = $nbPhotos ? 'label-success' : 'label-default' ;
        $html = array();
        $html[] = '<span class="label ' . $label . '">';
        $html[] = $nbPhotos;
        $html[] = '</span>';

        return implode("\r\n", $html);
    }
}
