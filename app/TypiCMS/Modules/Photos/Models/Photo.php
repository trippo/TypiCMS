<?php
namespace TypiCMS\Modules\Photos\Models;

use Dimsav\Translatable\Translatable;
use Croppa;
use TypiCMS\Models\Base;
use TypiCMS\Presenters\PresentableTrait;
use TypiCMS\Traits\Historable;

class Photo extends Base
{

    use Historable;
    use Translatable;
    use PresentableTrait;

    protected $presenter = 'TypiCMS\Modules\Photos\Presenters\ModulePresenter';

    protected $fillable = array(
        'product_id',
        'folder_id',
        'user_id',
        'type',
        'name',
        'filename',
        'path',
        'extension',
        'mimetype',
        'width',
        'height',
        'filesize',
        'download_count',
        'position',
        // Translatable columns
        'keywords',
        'description',
        'alt_attribute',
    );

    /**
     * Translatable model configs.
     *
     * @var array
     */
    public $translatedAttributes = array(
        'keywords',
        'description',
        'alt_attribute',
    );

    protected $appends = ['alt_attribute', 'description', 'thumb', 'thumb_sm'];

    /**
     * Columns that are file.
     *
     * @var array
     */
    public $attachments = array(
        'filename',
    );

    /**
     * One file belongs to one product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function product()
    {
        return $this->belongsTo('TypiCMS\Modules\Products\Models\Product');
    }

    /**
     * Get translated title
     */
    public function getTitleAttribute($value)
    {
        return $value;
    }

    /**
     * Get translated alt attribute
     * @return string alt attribute
     */
    public function getAltAttributeAttribute()
    {
        return $this->alt_attribute;
    }

    /**
     * Get thumb attribute from presenter
     * @return string src
     */
    public function getThumbAttribute()
    {
        return $this->present()->thumbSrc(null, 40, [], 'filename');
    }

    /**
     * Get thumb attribute from presenter
     * @return string src
     */
    public function getThumbSmAttribute($value)
    {
        return $this->present()->thumbSrc(130, 130, [], 'filename');
    }

    /**
     * Get translated description
     * @return string description
     */
    public function getDescriptionAttribute()
    {
        return $this->description;
    }
    
    /**
     * Get back office’s index of models url
     * 
     * @return string|void
     */
    public function returnUrl()
    {
        try {
            return route('admin.products.edit',$this->product_id)."?tab=tab-photos";
        } catch (InvalidArgumentException $e) {
            Log::error($e->getMessage());
        }
    }
}
