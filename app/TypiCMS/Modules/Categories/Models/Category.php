<?php
namespace TypiCMS\Modules\Categories\Models;

use App;
use Route;
use Dimsav\Translatable\Translatable;
use TypiCMS\Models\Base;
use TypiCMS\NestableCollection;
use TypiCMS\Presenters\PresentableTrait;
use TypiCMS\Traits\Historable;

class Category extends Base
{

    use Historable;
    use Translatable;
    use PresentableTrait;

    protected $presenter = 'TypiCMS\Modules\Categories\Presenters\ModulePresenter';

    protected $fillable = array(
        'image',
        'position',
        'parent_id',
        'image',
        // Translatable columns
        'title',
        'slug',
        'excerpt',
        'description',
        'status',
    );

    /**
     * Translatable model configs.
     *
     * @var array
     */
    public $translatedAttributes = array(
        'title',
        'slug',
        'excerpt',
        'description',
        'status',
    );
    
    
    /**
     * Columns that are file.
     *
     * @var array
     */
    public $attachments = array(
        'image',
    );
    
    public function children()
    {
        return $this->hasMany('TypiCMS\Modules\Categories\Models\Category','parent_id');
    }

	/**
     * get the parent model
     */
    public function parent()
    {
        return $this->belongsTo('TypiCMS\Modules\Categories\Models\Category','parent_id')->whereNotNull('parent_id');
    }
    /**
     * Get public uri
     *
     * @return string|null string or void
     */
    public function getPublicUri($preview = false, $index = false, $lang = null)
    {
        $lang = $lang ? : App::getlocale() ;
        $parameters = [$this->translate($lang)->slug];
        if (! $preview && ! $this->translate($lang)->status) {
            $parameters = [null];
        }
        $route = array();
        $route['lang'] = $lang;
        $route['table'] = 'projects';
        $route['category'] = 'categories';

        $routeName = implode('.', $route);
        if (Route::has($routeName)) {
            return route($routeName, $parameters);
        }
        return null;
    }

    /**
     * Relations
     */
    public function projects()
    {
        return $this->hasMany('TypiCMS\Modules\Projects\Models\Project')->order();
    }


    /**
     * Pages are nestable
     *
     * @return NestableCollection object
     */
    public function newCollection(array $models = array())
    {
        return new NestableCollection($models, 'parent_id');
    }
    
}
