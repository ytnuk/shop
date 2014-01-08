<?php

namespace CMS\Shop\Presenter;

use CMS\Front\Presenter\Base as Presenter;

abstract class Base extends Presenter {

    /**
     * @inject
     * @var \CMS\Shop\Category\Control
     */
    public $categoryControl;

    protected function createComponentCategory() {
        return $this->categoryControl;
    }

}
