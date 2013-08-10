<?php

namespace CMS\Shop;

use CMS\Front\BasePresenter as Presenter;

abstract class BasePresenter extends Presenter {

    /**
     * @inject
     * @var CMS\Shop\Component\Products\ProductsControl
     */
    public $products;

    public function createComponentProducts() {
        return $this->products;
    }

}