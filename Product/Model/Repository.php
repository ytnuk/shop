<?php

namespace WebEdit\Shop\Product\Model;

use WebEdit\Database;

final class Repository extends Database\Repository {

    protected $table = "shop_product";

    public function getProduct($id) {
        return $this->getOne($id);
    }

    public function getProductsInNodes($nodes) {
        return $this->getAll(array('node_id' => $nodes));
    }

}
