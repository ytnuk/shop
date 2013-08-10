<?php

namespace CMS\Shop\Model;

use CMS\Model\BaseRepository as Repository;
use Nette\Database\Table;

final class ProductRepository extends Repository {

    /**
     * 
     * @param int $id
     * @return Table\ActiveRow
     */
    public function getProduct($id) {
        return $this->table()->get($id);
    }

    public function getProductsInCategories($categories) {
        return $this->table()->where('category_id', $categories);
    }

}