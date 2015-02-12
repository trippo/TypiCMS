<?php
namespace TypiCMS\Modules\Products\Composers;

use Illuminate\Support\Facades\Config;
use Illuminate\View\View;

class SidebarViewComposer
{
    public function compose(View $view)
    {
        $view->menus['content']->put('products', [
            'weight' => Config::get('products::admin.weight'),
            'request' => $view->prefix . '/products*',
            'route' => 'admin.products.index',
            'icon-class' => 'icon fa fa-fw fa-barcode',
            'title' => 'Products',
        ]);
    }
}
