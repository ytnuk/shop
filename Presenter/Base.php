<?php

namespace WebEdit\Shop\Presenter;

use WebEdit\Front\Presenter\Base as Presenter;

abstract class Base extends Presenter {

    /**
     * @inject
     * @var \WebEdit\Shop\Category\Control
     */
    public $categoryControl;

    protected function createComponentCategory() {
        return $this->categoryControl;
    }

}
