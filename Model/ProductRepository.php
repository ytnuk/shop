<?php

namespace CMS\Shop\Model;

use CMS\Model\BaseRepository;

final class ProductRepository extends BaseRepository {

    public function getProduct($id) {
        return $this->find($id);
    }

    public function getProductsInCategories($categories) {
        $row = $this->connection->select('*')->from($this->getTable())->where('category_id IN (%i)', $categories)->fetchAll();
        return $this->createEntities($row);
    }

}