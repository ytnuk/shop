<?php

namespace WebEdit\Shop\Product;

use WebEdit\Database;

final class Repository extends Database\Repository {

    public function getProduct($id) {
        return $this->storage()->get($id);
    }

    public function getProducts($ids) {
        return $this->storage()->where('id', $ids);
    }

    public function getProductsInMenu($menu) {
        return $this->storage()->where('menu_id', $menu);
    }

    public function countProductsInMenu($menu) {
        return $this->getProductsInMenu($menu)->count('*');
    }

}
