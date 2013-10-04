<?php

namespace CMS\Shop\Model;

use CMS\Model\DatabaseRepository;

final class CategoryRepository extends DatabaseRepository {

    protected $name = 'shop_category';

    public function getCategory($id) {
        return $this->getOne($id);
    }

    /**
     * @return int[]
     */
    public function getIdsOfParentNodes() {
        return array_values($this->getPairs('id', 'node_id'));
    }

}
