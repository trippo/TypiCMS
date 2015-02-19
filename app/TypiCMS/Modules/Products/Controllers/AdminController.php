<?php
namespace TypiCMS\Modules\Products\Controllers;

use Illuminate\Database\Eloquent\Model;
use JavaScript;
use Response;
use Session;
use TypiCMS\Controllers\AdminSimpleController;
use TypiCMS\Modules\Products\Repositories\ProductInterface;
use TypiCMS\Modules\Products\Services\Form\ProductForm;
use TypiCMS\Modules\Tags\Models\Tag;
use View;

class AdminController extends AdminSimpleController
{

    public function __construct(ProductInterface $product, ProductForm $productform)
    {
        parent::__construct($product, $productform);
        $this->title['parent'] = trans_choice('products::global.products', 2);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        JavaScript::put([
            'tags' => Tag::lists('tag')
        ]);
        $model = $this->repository->getModel();
        $tags = Session::getOldInput('tags');
        $this->layout->content = View::make('admin.create')
            ->withTags($tags)
            ->withModel($model);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Model    $model
     * @return Response
     */
    public function edit(Model $model)
    {
        JavaScript::put([
            'tags' => Tag::lists('tag')
        ]);

        $tags = implode(', ', $model->tags->lists('tag'));
        $this->layout->content = View::make('admin.edit')
            ->withTags($tags)
            ->withModel($model);
    }
}
