<?php

namespace WebEdit\Shop;

use WebEdit\Front;
use WebEdit\Shop\Cart;

abstract class Presenter extends Front\Presenter {

    /**
     * @inject
     * @var Cart\Control\Factory
     */
    public $cartControlFactory;

    protected function createComponentCart() {
        return $this->cartControlFactory->create();
    }

}
