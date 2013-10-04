<?php

namespace CMS\Shop\Model;

use CMS\Model\DatabaseRepository;

final class ProductRepository extends DatabaseRepository {

    protected $name = "shop_product";

    public function getProduct($id) {
        return $this->getOne($id);
    }

    public function getProductsInNodes($nodes) {
        return $this->getAll(array('node_id' => $nodes));
    }

}
