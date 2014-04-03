<?php

namespace WebEdit\Shop\Cart;

use WebEdit\Session;

final class Repository extends Session\Repository {

    public function getIdsOfItems() {
        return array_keys($this->getAll());
    }

}
