<?php

namespace CMS\Shop\Model;

use CMS\Model\BaseRepository;

final class ProductRepository extends BaseRepository {

    protected $name = "shop_product";

    public function getProduct($id) {
        return $this->table()->get($id);
    }

    public function getProductsInNodes($nodes) {
        return $this->table()->where('node_id', $nodes)->fetchAll();
    }

    public function countProductsInNodes($nodes) {
        return $this->table()->where('node_id', $nodes)->count();
    }

}
