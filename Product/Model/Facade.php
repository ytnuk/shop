<?php

namespace WebEdit\Shop\Product\Model;

use WebEdit\Model;
use WebEdit\Shop\Product;
use WebEdit\Menu;

class Facade extends Model\Facade {

    public $repository;
    private $categoryFacade;

    public function __construct(Product\Model\Repository $repository, Menu\Model\Facade $categoryFacade) {
        $this->repository = $repository;
        $this->categoryFacade = $categoryFacade;
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
