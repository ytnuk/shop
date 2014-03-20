<?php

namespace WebEdit\Shop\Cart;

use WebEdit\Session;

final class Repository extends Session\Repository {

    public function getItem($key) {
        return isset($this->storage->items[$key]) ? $this->storage->items[$key] : NULL;
    }

    public function getItemKeys() {
        return array_keys($this->getItems());
    }

    public function getItems() {
        return $this->storage->items ? $this->storage->items : array();
    }

    public function insertItem($key, $quantity = 1) {
        $this->storage->items[$key] = $quantity;
    }

    public function removeItem($key) {
        unset($this->storage->items[$key]);
    }

    public function removeItems() {
        $this->storage->remove();
    }

}
