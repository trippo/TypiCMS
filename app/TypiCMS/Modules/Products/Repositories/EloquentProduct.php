<?php
namespace TypiCMS\Modules\Products\Repositories;

use Illuminate\Database\Eloquent\Model;
use TypiCMS\Repositories\RepositoriesAbstract;
use TypiCMS\Modules\Tags\Repositories\TagInterface;
use TypiCMS\Modules\Photos\Repositories\Photo;

class EloquentProduct extends RepositoriesAbstract implements ProductInterface
{

    protected $tag;

    // Class expects an Eloquent model and a TagInterface
    public function __construct(Model $model, TagInterface $tag)
    {
        $this->model = $model;
        $this->tag = $tag;
    }

    /**
     * Create a new model
     *
     * @param array  Data to create a new object
     * @return boolean
     */
    public function create(array $data)
    {
        if ($model = $this->model->create($data)) {
            isset($data['tags']) && $this->syncTags($model, $data['tags']);

            return $model;
        }

        return false;
    }

    /**
     * Update an existing model
     *
     * @param array  Data to update a model
     * @return boolean
     */
    public function update(array $data)
    {
        $model = $this->model->find($data['id']);
        $model->fill($data);
        $model->save();
        isset($data['tags']) && $this->syncTags($model, $data['tags']);

        return true;
    }
    
    /**
     * Delete model and attached photos
     *
     * @return boolean
     */
    public function delete($model)
    {
        if ($model->photos) {
            $model->photos->each(function (Photo $photo) {
                $photo->delete();
            });
        }
        
        if ($model->delete()) {
            return true;
        }

        return false;
    }
}
