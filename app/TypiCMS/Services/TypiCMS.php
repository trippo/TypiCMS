<?php
namespace TypiCMS\Services;

use App;
use HTML;
use Route;
use Config;
use Request;

/**
* LangSwitcher
*/
class TypiCMS
{
    private $model;

    /**
    * Set model
    *
    * @param Model $model
    */
    public function setModel($model)
    {
        $this->model = $model;
    }

    /**
    * Get Homepage URI
    *
    * @return string
    */
    public function homepage()
    {
        $uri = '/';
        if (Config::get('app.main_locale_in_url') || Config::get('app.fallback_locale') != App::getLocale()) {
            $uri .= App::getLocale();
        }
        return $uri;
    }

    /**
    * Return online public locales
    *
    * @return array
    */
    public function getPublicLocales()
    {
        $locales = Config::get('app.locales');
        foreach ($locales as $key => $locale) {
            if (! Config::get('typicms.' . $locale . '.status')) {
                unset($locales[$key]);
            }
        }
        return $locales;
    }

    /**
    * Build languages menu
    *
    * @param array $attributes
    * @return string
    */
    public function languagesMenu(array $attributes = array())
    {
        $locales = $this->getPublicLocales();
        $langsArray = $this->buildLangsArray($locales);
        return HTML::languagesMenu($langsArray, $attributes);
    }

    /**
    * Build langs array
    *
    * @param array $locales
    * @return array
    */
    private function buildLangsArray(array $locales = array())
    {
        $langsArray = array();
        foreach ($locales as $locale) {
            $langsArray[] = (object) array(
                'lang' => $locale,
                'url' => $this->getTranslatedUrl($locale),
                'class' => Config::get('app.locale') == $locale ? 'active' : ''
            );
        }
        return $langsArray;
    }

    /**
    * Get url from model
    *
    * @param string $lang
    * @return string
    */
    private function getTranslatedUrl($lang)
    {
        if ($this->model && $this->model->id) {
            return $this->model->getPublicUri(false, false, $lang);
        }
        if ($routeName = Route::current()->getUri() != '/') {
            $routeName = $lang . strstr(Route::current()->getName(), '.');
            if ($routeName == $lang) {
                return '/' . $lang;
            }
            if (Route::has($routeName)) {
                return route($routeName);
            }
        }
        return '/' . $lang;
    }

    /**
    * Get public url when no model loaded
    *
    * @return string
    */
    public function getPublicUrl()
    {
        $lang = Config::get('app.locale');
        $routeArray = explode('.', Route::current()->getName());
        $routeArray[0] = $lang;
        array_pop($routeArray);
        $route = implode('.', $routeArray);

        if (Route::has($route)) {
            return route($route);
        }
        if (
            ! Config::get('typicms.langChooser') &&
            Config::get('app.fallback_locale') == $lang &&
            ! Config::get('app.main_locale_in_url')
        ) {
            return '/';
        }
        return '/' . $lang;
    }

    /**
    * Build public link
    *
    * @param array $attributes
    * @return string
    */
    public function publicLink(array $attributes = array())
    {
        $url = $this->getPublicUrl();
        $title = ucfirst(trans('global.view website', array(), null, Config::get('typicms.adminLocale')));
        return HTML::link($url, $title, $attributes);
    }

    /**
    * Build admin link
    *
    * @param array $attributes
    * @return string
    */
    public function adminLink(array $attributes = array())
    {
        $url = route('dashboard');
        $title = ucfirst(trans('global.admin side', array(), null, Config::get('typicms.adminLocale')));
        if ($this->model) {
            if (! $this->model->id) {
                $url = $this->model->indexUrl();
            } else {
                $url = $this->model->editUrl();
            }
            $url .= '?locale=' . App::getLocale();
        }
        return HTML::link($url, $title, $attributes);
    }

    /**
    * Build admin or public link
    *
    * @param array $attributes
    * @return string
    */
    public function otherSideLink(array $attributes = array())
    {
        if ($this->isAdmin()) {
            return $this->publicLink($attributes);
        }
        return $this->adminLink($attributes);
    }

    /**
    * Check if we are on back office
    *
    * @return boolean true if we are on backend
    */
    public function isAdmin()
    {
        if (Request::segment(1) == 'admin') {
            return true;
        }
        return false;
    }

    /**
     * Indent values of an array of pages with spaces.
     *
     * @return array
     */
    public function arrayIndent($array)
    {
        $parent = 0;
        $items = [];
        foreach ($array as $item) {
            $indent = '';
            if ($item->parent_id) {
                $indent = '&nbsp;&nbsp;&nbsp;&nbsp;';
                if ($parent && $parent < $item->parent_id) {
                    $indent .= $indent;
                }
            }
            $parent = $item->parent_id;
            $items[$indent . $item->title] = $item->id;
        }
        return $items;
    }
}
