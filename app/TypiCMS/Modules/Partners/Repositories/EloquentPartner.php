<?php
namespace TypiCMS\Modules\Partners\Repositories;

use Illuminate\Database\Eloquent\Model;
use TypiCMS\Repositories\RepositoriesAbstract;

class EloquentPartner extends RepositoriesAbstract implements PartnerInterface
{

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Get all categories for select/option
     *
     * @return array
     */
    public function getAllForSelect()
    {
        $categories = $this->make(['translations'])
            ->whereHasOnlineTranslation()
            ->order()
            ->get()
            ->lists('title', 'id');

        return ['' => ''] + $categories;
    }
    
}
