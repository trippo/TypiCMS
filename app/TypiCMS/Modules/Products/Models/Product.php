<?php
namespace TypiCMS\Modules\Products\Models;

use Dimsav\Translatable\Translatable;
use TypiCMS\Models\Base;
use TypiCMS\Presenters\PresentableTrait;
use TypiCMS\Traits\Historable;

class Product extends Base
{

    use Historable;
    use Translatable;
    use PresentableTrait;

    protected $presenter = 'TypiCMS\Modules\Products\Presenters\ModulePresenter';

    protected $fillable = array(
        'category_id',
        'partner_id',
        'image',
        'sku',
        'price',
        'discount',
        'weight',
        'related_products',
        'images',
        
        // Translatable columns
        'title',
        'slug',
        'status',
        'summary',
        'body',
        'meta_title',
        'meta_keywords',
        'meta_description',
        'others_meta',
    );

    /**
     * Translatable model configs.
     *
     * @var array
     */
    public $translatedAttributes = array(
        'title',
        'slug',
        'status',
        'summary',
        'body',
        'meta_title',
        'meta_keywords',
        'meta_description',
        'others_meta',
    );

    /**
     * Columns that are file.
     *
     * @var array
     */
    public $attachments = array(
        'image',
    );

    protected $appends = ['status', 'title', 'thumb', 'category_name', 'partner_name', 'photos_count'];

    /**
     * Relation
     */
    public function category()
    {
        return $this->belongsTo('TypiCMS\Modules\Categories\Models\Category');
    }
    
    
    /**
     * One product has many photos.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function photos()
    {
        return $this->hasMany('TypiCMS\Modules\Photos\Models\Photo')->order();
    }


    /**
     * Relation
     */
    public function partner()
    {
        return $this->belongsTo('TypiCMS\Modules\Partners\Models\Partner');
    }

    /**
     * Get name of the category from category table
     * and append it to main model attributes
     * @return string title
     */
    public function getCategoryNameAttribute()
    {
        if ($this->category) {
            return $this->category->title;
        }
        return null;
    }


    /**
     * Get name of the category from category table
     * and append it to main model attributes
     * @return string title
     */
    public function getPartnerNameAttribute()
    {
        if ($this->partner) {
            return $this->partner->title;
        }
        return null;
    }
    
    

    /**
     * Get photos count
     * 
     * @return string title
     */
    public function getPhotosCountAttribute()
    {
        return $this->photos->count();
    }
}
