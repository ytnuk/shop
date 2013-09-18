<?php

namespace CMS\Admin\Shop;

use Nette\Application\BadRequestException;

final class ProductPresenter extends BasePresenter {

    /**
     * @inject
     * @var \CMS\Shop\Model\ProductFacade
     */
    public $productFacade;
    private $product;

    /**
     * @inject
     * @var \CMS\Shop\Form\ProductFormFactory
     */
    public $productFormFactory;

    protected function beforeRender() {
        parent::beforeRender();
        $this->menu->breadcrumbAdd('Product list', 'Product:list');
    }

    public function renderAdd() {
        $this->menu->breadcrumbAdd('Add new product');
    }

    public function actionEdit($id) {
        $this->product = $this->productFacade->repository->getProduct($id);
        if (!$this->product) {
            throw new BadRequestException;
        }
    }

    public function renderEdit() {
        $this->menu->breadcrumbAdd('Edit product: ' . $this->product->title);
    }

    public function renderList() {
        
    }

    protected function createComponentProductFormAdd() {
        return $this->productFormFactory->create();
    }

    protected function createComponentProductFormEdit() {
        return $this->productFormFactory->create($this->product);
    }

}
