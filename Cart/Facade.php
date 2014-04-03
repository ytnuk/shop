<?php

namespace WebEdit\Shop\Cart;

use WebEdit\Shop\Cart;

final class Facade {

    private $repository;

    public function __construct(Cart\Repository $repository) {
        $this->repository = $repository;
    }

    public function add($key, $data) {
        $this->repository->insert($key, $data['item']);
    }

    public function edit($key, $data) {
        $this->repository->update($key, $data['item']);
    }

    public function delete($key) {
        $this->repository->remove($key);
    }

}
