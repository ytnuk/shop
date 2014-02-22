<?php

namespace WebEdit\Shop\Product\Admin;

use WebEdit\Shop;

final class Presenter extends Shop\Admin\Presenter {

    /**
     * @inject
     * @var \WebEdit\Shop\Product\Repository
     */
    public $repository;

    /**
     * @inject
     * @var \WebEdit\Shop\Product\Form\Factory
     */
    public $formFactory;
    private $product;

    public function renderAdd() {
        $this['menu']['breadcrumb'][] = $title = $this->translator->translate('shop.product.admin.add');
    }

    public function actionEdit($id) {
        $this->product = $this->repository->getProduct($id);
        if (!$this->product) {
            $this->error();
        }
    }

    public function renderEdit() {
        $this['menu']['breadcrumb'][] = $this->translator->translate('shop.product.admin.edit', NULL, ['product' => $this->product->title]);
    }

    protected function createComponentProductFormAdd() {
        return $this->formFactory->create();
    }

    protected function createComponentProductFormEdit() {
        return $this->formFactory->create($this->product);
    }

}
