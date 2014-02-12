<?php

namespace WebEdit\Shop\Product\Model;

use WebEdit\Database;

final class Repository extends Database\Repository {

    public function getProduct($id) {
        return $this->table()->get($id);
    }

    public function getProductsInMenu($menu) {
        return $this->table()->where('menu_id', $menu);
    }

    public function countProductsInMenu($menu) {
        return $this->getProductsInMenu($menu)->count('*');
    }

}
