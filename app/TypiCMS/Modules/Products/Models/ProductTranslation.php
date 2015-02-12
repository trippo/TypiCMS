<?php
namespace TypiCMS\Modules\Products\Models;

use TypiCMS\Models\BaseTranslation;

class ProductTranslation extends BaseTranslation
{
    /**
     * get the parent model
     */
    public function owner()
    {
        return $this->belongsTo('TypiCMS\Modules\Products\Models\Product', 'product_id');
    }
}
