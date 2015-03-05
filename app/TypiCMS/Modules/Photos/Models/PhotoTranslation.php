<?php
namespace TypiCMS\Modules\Photos\Models;

use TypiCMS\Models\BaseTranslation;

class PhotoTranslation extends BaseTranslation
{
    /**
     * get the parent model
     */
    public function owner()
    {
        return $this->belongsTo('TypiCMS\Modules\Photos\Models\Photo', 'photo_id');
    }
}
