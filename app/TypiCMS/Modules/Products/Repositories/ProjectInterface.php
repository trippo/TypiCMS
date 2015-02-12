<?php
namespace TypiCMS\Modules\Products\Repositories;

use TypiCMS\Repositories\RepositoryInterface;

interface ProductInterface extends RepositoryInterface
{

    /**
     * Create a new Article
     *
     * @param array  Data to create a new object
     * @return boolean
     */
    public function create(array $data);

    /**
     * Update an existing Article
     *
     * @param array  Data to update an Article
     * @return boolean
     */
    public function update(array $data);
}
