<?php

namespace WebEdit\Shop\Product;

use WebEdit\Application;
use WebEdit\Shop\Product;

final class Presenter extends Application\Front\Presenter {

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
        $this['menu']->setEntity($this->product->menu);
        $this['menu'][] = $this->product->title;
    }

    protected function createComponentProduct() {
        return $this->control->create();
    }

}
