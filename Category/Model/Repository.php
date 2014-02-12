<?php

namespace WebEdit\Shop\Category\Model;

use WebEdit\Database;

final class Repository extends Database\Repository {

    public function getCategory($id) {
        return $this->table()->get($id);
    }

    public function getAllCategories() {
        return $this->table();
    }

}
