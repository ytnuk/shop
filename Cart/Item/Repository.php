<?php

namespace WebEdit\Shop\Cart\Item;

use WebEdit\Session;
use WebEdit\Shop\Cart\Item;

class Repository extends Session\Repository {

    public function getItem($key) {
        return isset($this->storage[$key]) ? $this->storage[$key] : NULL;
    }

    public function getItems() {
        return $this->storage;
    }

    public function insertItem($key, $data, $quantity = 1) {
        $item = $this->getItem($key);
        if (!$item) {
            $item = new Item\Entity;
        }
        $item->quantity+= $quantity;
        $item->data = $data;
        $this->storage[$key] = $item;
    }

    public function removeItem($key, $quantity = NULL) {
        if ($quantity) {
            $item = $this->getItem($key);
            $item->quantity-=$quantity;
        } else {
            unset($this->storage[$key]);
        }
    }

    public function removeItems() {
        $this->storage->remove();
    }

}
