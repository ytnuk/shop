<?php

namespace CMS\Shop\Model;

use CMS\Model\Facade;
use CMS\Shop\Model\ProductRepository;
use CMS\Menu\Model\NodeFacade;
use CMS\Shop\Form\ProductFormContainer;

class ProductFacade extends Facade {

    public $repository;
    private $categoryFacade;

    public function __construct(ProductRepository $repository, NodeFacade $categoryFacade) {
        $this->repository = $repository;
        $this->categoryFacade = $categoryFacade;
    }

    public function getFormContainer($product = NULL) {
        return new ProductFormContainer($product);
    }

    public function addProduct(array $data) {
        $data = array_merge($data['product'], $data['node']);
        return $this->repository->insertProduct($data);
    }

    public function editProduct($product, array $data) {
        $data = array_merge($data['product'], $data['node']);
        return $this->repository->updateProduct($product, $data);
    }

    public function deleteProduct($product) {
        return $this->repository->removeProduct($product);
    }

}
