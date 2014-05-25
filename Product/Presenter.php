<?php

namespace WebEdit\Shop\Product;

use WebEdit\Shop;
use WebEdit\Shop\Product;

final class Presenter extends Shop\Presenter {

    /**
     * @inject
     * @var Product\Repository
     */
    public $repository;
    private $product;

    /**
     * @inject
     * @var Product\Control\Factory
     */
    public $control;

    public function actionView($id) {
        $this->product = $this->repository->getProduct($id);
        if (!$this->product) {
            $this->error();
        }
        $this['product']->setEntity($this->product);
    }

    public function renderView() {
        $this['menu']['breadcrumb'][] = $this->product->menu;
        $this['menu']['breadcrumb'][] = $this->product->title;
    }

    protected function createComponentProduct() {
        return $this->control->create();
    }

}
