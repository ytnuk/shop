<?php

namespace CMS\Shop\Model;

use CMS\Model\BaseRepository;

final class ProductRepository extends BaseRepository {

    public function getProduct($id) {
        return $this->table()->get($id);
    }

    public function getProductsInCategories($categories) {
        return $this->table()->where('category_id', $categories)->fetchAll();
    }

}