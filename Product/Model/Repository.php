<?php

namespace WebEdit\Shop\Product\Model;

use WebEdit\Database;

final class Repository extends Database\Repository {

    protected $table = "shop_product";

    public function getProduct($id) {
        return $this->table()->get($id);
    }

    public function getProductsInNodes($nodes) {
        return $this->table()->where('node_id', $nodes);
    }

    public function countProductsInNodes($nodes) {
        return $this->getProductsInNodes($nodes)->count('*');
    }

}
