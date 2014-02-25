<?php

namespace WebEdit\Shop\Cart\Item;

use WebEdit\Session;
use WebEdit\Shop\Cart\Item;

class Repository extends Session\Repository {

    public function getItem($key) {
        return isset($this->storage->data[$key]) ? $this->storage->data[$key] : NULL;
    }

    public function getItems() {
        return $this->storage->data;
    }

    public function insertItem($key, $data = NULL, $quantity = 1) {
        $item = $this->getItem($key);
        if (!$item) {
            $item = new Item\Entity;
        }
        $item->quantity+= $quantity;
        if ($data) {
            $item->data = $data;
        }
        $this->storage->data[$key] = $item;
    }

    public function removeItem($key, $quantity = NULL) {
        if ($quantity) {
            $item = $this->getItem($key);
            $item->quantity-=$quantity;
        } else {
            unset($this->storage->data[$key]);
        }
    }

    public function removeItems() {
        $this->storage->remove();
    }

}
