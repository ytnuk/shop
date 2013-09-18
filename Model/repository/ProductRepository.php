<?php

namespace CMS\Shop\Model;

use CMS\Model\Repository;

final class ProductRepository extends Repository {

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

    public function insertProduct($data) {
        return $this->table()->insert($data);
    }

    public function updateProduct($product, array $data) {
        return $product->update($data);
    }

    public function removeProduct($product) {
        return $product->delete();
    }

}
