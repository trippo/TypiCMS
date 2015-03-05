<?php
namespace TypiCMS\Modules\Photos\Repositories;

use App;
use Input;
use TypiCMS\Repositories\CacheAbstractDecorator;
use TypiCMS\Services\Cache\CacheInterface;

class CacheDecorator extends CacheAbstractDecorator implements PhotoInterface
{

    public function __construct(PhotoInterface $repo, CacheInterface $cache)
    {
        $this->repo = $repo;
        $this->cache = $cache;
    }

    /**
     * Get paginated models
     *
     * @param  int      $page  Number of models per page
     * @param  int      $limit Results per page
     * @param  model    $product_id  related model
     * @param  boolean  $all   get published models or all
     * @param  array    $with  Eager load related models
     * @param  string   $type  file type : a,v,d,i,o
     * @return stdClass Object with $items && $totalItems for pagination
     */
    public function byPageFrom(
        $page = 1,
        $limit = 10,
        $product_id = null,
        array $with = array(),
        $all = false,
        $type = null
    ) {
        $cacheKey = md5(
            App::getLocale() .
            'byPageFrom' .
            $page .
            $limit .
            $product_id .
            $all .
            implode('.', Input::except('page')) .
            $type
        );

        if ($this->cache->has($cacheKey)) {
            return $this->cache->get($cacheKey);
        }

        $models = $this->repo->byPageFrom($page, $limit, $product_id, $with, $all, $type);

        // Store in cache for next request
        $this->cache->put($cacheKey, $models);

        return $models;

    }
}
