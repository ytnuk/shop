<?php

namespace WebEdit\Shop;

use WebEdit\Front;

abstract class Presenter extends Front\Presenter {

    /**
     * @inject
     * @var \WebEdit\Shop\Cart\Control\Factory
     */
    public $cartControlFactory;

    protected function createComponentCart() {
        return $this->cartControlFactory->create();
    }

}
