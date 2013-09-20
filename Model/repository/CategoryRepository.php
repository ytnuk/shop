<?php

namespace CMS\Shop\Model;

use CMS\Model\DatabaseRepository;

final class CategoryRepository extends DatabaseRepository {

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

}
