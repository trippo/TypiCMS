<?php
namespace TypiCMS\Filters;

use App;
use Input;
use Config;
use Sentry;
use Request;
use Redirect;

/**
 * Public filter
 */
class PublicFilter
{

    public function checkLocale()
    {

        $locale = Request::segment(1);

        // Throw a 404 if website in this language is offline
        if (! Config::get('typicms.' . $locale . '.status')) {
            App::abort(404);
        }

        // Throw a 404 if in preview mode without admin user connected
        if (Input::get('preview') && ! Sentry::check()) {
            return Redirect::to(Request::path());
        }

    }
}
