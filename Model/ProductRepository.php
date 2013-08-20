<?php

namespace CMS\Shop\Model;

use CMS\Model\BaseRepository;
use Nette\Database\Table;

final class ProductRepository extends BaseRepository {

    /**
     * @param int $id
     * @return Table\ActiveRow
     */
    public function getProduct($id) {
        return $this->table()->get($id);
    }

    /**
     * @param int[] $categories
     * @return Table\Selection
     */
    public function getProductsInCategories($categories) {
        return $this->table()->where('category_id', $categories);
    }

}