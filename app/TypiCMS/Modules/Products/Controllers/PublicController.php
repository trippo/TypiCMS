<?php
namespace TypiCMS\Modules\Products\Controllers;

use App;
use Str;
use View;
use TypiCMS;
use TypiCMS\Modules\Products\Repositories\ProductInterface;
use TypiCMS\Controllers\BasePublicController;

class PublicController extends BasePublicController
{

    public function __construct(ProductInterface $product)
    {
        parent::__construct($product);
        $this->title['parent'] = Str::title(trans_choice('products::global.products', 2));
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($category = null)
    {
        TypiCMS::setModel($this->repository->getModel());

        $this->title['child'] = '';

        $relatedModels = array('translations', 'category', 'category.translations');

        if ($category) {
            $models = $this->repository->getAllBy('category_id', $category->id, $relatedModels, false);
            TypiCMS::setModel($category); // Needed for building lang switcher
        } else {
            $models = $this->repository->getAll($relatedModels, false);
        }

        $this->layout->content = View::make('products.public.index')
            ->with('category', $category)
            ->with('models', $models);
    }

    /**
     * Show resource.
     *
     * @return Response
     */
    public function show($category = null, $slug = null)
    {
        $model = $this->repository->bySlug($slug);
        if ($category->id != $model->category_id) {
            App::abort(404);
        }

        TypiCMS::setModel($model);

        $this->title['parent'] = $model->title;

        $this->layout->content = View::make('products.public.show')
            ->with('model', $model);
    }
}
