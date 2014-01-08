<?php

namespace CMS\Shop\Product\Model;

use CMS\Model;
use CMS\Shop\Product;
use CMS\Menu\Node;

class Facade extends Model\Facade {

    public $repository;
    private $categoryFacade;

    public function __construct(Product\Model\Repository $repository, Node\Model\Facade $categoryFacade) {
        $this->repository = $repository;
        $this->categoryFacade = $categoryFacade;
    }

    public function getFormContainer($product = NULL) {
        return new Product\Form\Container($product);
    }

    public function addProduct(array $data) {
        $data = array_merge($data['product'], $data['node']);
        return $this->repository->insert($data);
    }

    public function editProduct($product, array $data) {
        $data = array_merge($data['product'], $data['node']);
        return $this->repository->update($product, $data);
    }

    public function deleteProduct($product) {
        return $this->repository->remove($product);
    }

}
