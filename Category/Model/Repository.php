<?php

namespace WebEdit\Shop\Category\Model;

use WebEdit\Database;

final class Repository extends Database\Repository {

    protected $table = 'shop_category';

    public function getCategory($id) {
        return $this->getOne($id);
    }

    public function getAllCategories($where = NULL, $order = NULL) {
        return $this->getAll($where, $order);
    }

    /**
     * @return int[]
     */
    public function getIdsOfParentNodes() {
        return array_values($this->getPairs('id', 'node_id'));
    }

}
