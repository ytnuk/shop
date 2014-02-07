<?php

namespace WebEdit\Shop\Product\Admin;

use WebEdit\Shop;

final class Presenter extends Shop\Admin\Presenter {

    /**
     * @inject
     * @var \WebEdit\Shop\Product\Model\Facade
     */
    public $productFacade;

    /**
     * @inject
     * @var \WebEdit\Shop\Product\Form\Factory
     */
    public $productFormFactory;
    private $product;

    protected function startup() {
        parent::startup();
        $this->menu->breadcrumb->fromLink(':Shop:Product:Admin:Presenter:view');
    }

    public function renderAdd() {
        $this->menu->breadcrumb->append(
                $this->translator->translate('shop.product.admin.add'), 'Presenter:add');
    }

    public function actionEdit($id) {
        $this->product = $this->productFacade->repository->getProduct($id);
        if (!$this->product) {
            $this->error();
        }
    }

    public function renderEdit() {
        $this->menu->breadcrumb->append(
                $this->translator->translate('shop.product.admin.edit', NULL, ['product' => $this->product->title]), 'Presenter:edit', $this->product->id);
    }

    protected function createComponentProductFormAdd() {
        return $this->productFormFactory->create();
    }

    protected function createComponentProductFormEdit() {
        return $this->productFormFactory->create($this->product);
    }

}
