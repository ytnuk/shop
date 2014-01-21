<?php

namespace WebEdit\Shop;

use WebEdit\Front;

abstract class Presenter extends Front\Presenter {

    /**
     * @inject
     * @var \WebEdit\Shop\Category\Control
     */
    public $categoryControl;

    protected function createComponentCategory() {
        return $this->categoryControl;
    }

}
