<?php
namespace TypiCMS\Modules\Photos\Presenters;

use Illuminate\Database\Eloquent\Model;
use TypiCMS\Presenters\Presenter;

class ModulePresenter extends Presenter
{

    /**
     * Get the path of Photos linked to this model
     * 
     * @param  Model  $model
     * @param  string $field Photo's field name in model
     * @return string path
     */
    protected function getPath(Model $model = null, $field = null)
    {
        if (! $model || ! $field) {
            return null;
        }
        return '/' . $model->path . '/' . $model->$field;
    }

    /**
     * Return an icon and Photo name
     *
     * @param  int    $size    icon size
     * @param  string $field   field name
     * @return string          HTML code
     */
    public function icon($size = 1, $field = 'document')
    {
        $photo = $this->getPath($this->entity, $field);
        $html = '<div class="doc">';
        $html .= '<span class="text-center fa fa-image-o fa-' . $size . 'x"></span>';
        $html .= ' <a href="' . $photo . '">';
        $html .= $this->entity->$field;
        $html .= '</a>';
        if (! is_file(public_path() . $photo)) {
            $html .= ' <span class="text-danger">(' . trans('global.Not found') . ')</span>';
        }
        $html .= '</div>';
        return $html;
    }

    /**
     * Get title
     * 
     * @return string
     */
    public function title()
    {
        return $this->entity->filename;
    }
}
