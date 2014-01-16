<?php

namespace WebEdit\Shop\Admin\Presenter;

use WebEdit\Shop\Admin\Presenter\Base;

final class Product extends Base {

    /**
     * @inject
     * @var \WebEdit\Shop\Product\Model\Facade
     */
    public $productFacade;
    private $product;

    /**
     * @inject
     * @var \WebEdit\Shop\Product\Form\Factory
     */
    public $productFormFactory;

    protected function startup() {
        parent::startup();
        $this->menu->setActive(':Shop:Admin:Product:list');
    }

    public function renderAdd() {
        $this->menu->breadcrumbAdd(
                $this->translator->translate('shop.admin.product.add'), 'Product:add');
    }

    public function actionEdit($id) {
        $this->product = $this->productFacade->repository->getProduct($id);
        if (!$this->product) {
            $this->error();
        }
    }

    public function renderEdit() {
        $this->menu->breadcrumbAdd(
                $this->translator->translate('shop.admin.product.edit', NULL, ['product' => $this->product->title]), 'Product:edit', $this->product->id);
    }

    protected function createComponentProductFormAdd() {
        return $this->productFormFactory->create();
    }

    protected function createComponentProductFormEdit() {
        return $this->productFormFactory->create($this->product);
    }

}
