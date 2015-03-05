<?php
namespace TypiCMS\Modules\Photos\Composers;

use Illuminate\Support\Facades\Config;
use Illuminate\View\View;

class SidebarViewComposer
{
    public function compose(View $view)
    {
        $view->menus['media']->put('photos', [
            'weight' => Config::get('photos::admin.weight'),
            'request' => $view->prefix . '/photos*',
            'route' => 'admin.photos.index',
            'icon-class' => 'icon fa fa-fw fa-file-photo-o',
            'title' => 'Photos',
        ]);
    }
}
