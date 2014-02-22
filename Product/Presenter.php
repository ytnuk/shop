<?php

namespace WebEdit\Shop\Product;

use WebEdit\Shop;

final class Presenter extends Shop\Presenter {

    /**
     * @inject
     * @var \WebEdit\Shop\Product\Repository
     */
    public $repository;
    private $product;

    public function actionView($id) {
        $this->product = $this->repository->getProduct($id);
        if (!$this->product) {
            $this->error();
        }
        $this['menu']['breadcrumb'][] = $this->product->menu;
    }

    public function renderView() {
        $this['menu']['breadcrumb'][] = $this->product->title;
        $this->template->product = $this->product;
    }

}
