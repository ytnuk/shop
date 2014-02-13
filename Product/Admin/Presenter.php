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

    public function renderAdd() {
        $title = $this->translator->translate('shop.product.admin.add');
        $this->menu->breadcrumb->append($title);
    }

    public function actionEdit($id) {
        $this->product = $this->productFacade->repository->getProduct($id);
        if (!$this->product) {
            $this->error();
        }
    }

    public function renderEdit() {
        $title = $this->translator->translate('shop.product.admin.edit', NULL, ['product' => $this->product->title]);
        $this->menu->breadcrumb->append($title);
    }

    protected function createComponentProductFormAdd() {
        return $this->productFormFactory->create();
    }

    protected function createComponentProductFormEdit() {
        return $this->productFormFactory->create($this->product);
    }

}
