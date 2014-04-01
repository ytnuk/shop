<?php

namespace WebEdit\Shop\Product;

use WebEdit\Shop\Product;

final class Facade {

    public $repository;

    public function __construct(Product\Repository $repository) {
        $this->repository = $repository;
    }

    public function add(array $data) {
        $data = array_merge($data['product'], $data['menu']);
        return $this->repository->insert($data);
    }

    public function edit($product, array $data) {
        $data = array_merge($data['product'], $data['menu']);
        $this->repository->update($product, $data);
    }

    public function delete($product) {
        $this->repository->remove($product);
    }

}
