<?php

namespace CMS\Shop\Model;

use CMS\Model\Repository;

final class CategoryRepository extends Repository {

    protected $name = 'shop_category';

    public function getCategory($id) {
        return $this->table()->get($id);
    }

    /**
     * @return int[]
     */
    public function getIdsOfParentNodes() {
        $selection = $this->table()->fetchPairs('id', 'node_id');
        return array_values($selection);
    }

    public function insertCategory(array $data) {
        return $this->table()->insert($data);
    }

    public function updateCategory($category, array $data) {
        return $category->update($data);
    }

    public function removeCategory($category) {
        return $category->delete();
    }

}
