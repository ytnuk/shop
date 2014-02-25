<?php

namespace WebEdit\Shop\Cart\Item;

use WebEdit;
use WebEdit\Shop\Cart\Item;

class Facade extends WebEdit\Facade {

    public $repository;

    public function __construct(Item\Repository $repository) {
        $this->repository = $repository;
    }

    public function editItem($item, array $data) {
        $this->repository->insertItem($item->id, $item, $data['quantity']);
    }

}
