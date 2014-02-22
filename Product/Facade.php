<?php

namespace WebEdit\Shop\Product;

use WebEdit;
use WebEdit\Shop\Product;

class Facade extends WebEdit\Facade {

    public $repository;

    public function __construct(Product\Repository $repository) {
        $this->repository = $repository;
    }

    public function getFormContainer($product = NULL) {
        return new Product\Form\Container($product);
    }

    public function addProduct(array $data) {
        $data = array_merge($data['product'], $data['menu']);
        return $this->repository->insert($data);
    }

    public function editProduct($product, array $data) {
        $data = array_merge($data['product'], $data['menu']);
        return $this->repository->update($product, $data);
    }

    public function deleteProduct($product) {
        return $this->repository->remove($product);
    }

}
