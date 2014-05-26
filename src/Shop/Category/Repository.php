<?php

namespace WebEdit\Shop\Category;

use WebEdit\Database;

final class Repository extends Database\Repository {

    public function getCategory($id) {
        return $this->storage()->get($id);
    }

    public function getAllCategories() {
        return $this->storage();
    }

}
