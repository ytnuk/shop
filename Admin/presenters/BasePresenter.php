<?php

namespace CMS\Admin\Shop;

use CMS\Admin\BasePresenter as Presenter;

abstract class BasePresenter extends Presenter {

    /**
     * @inject
     * @var \CMS\Shop\Model\CategoryRepository
     */
    public $categoryRepository;

    protected function startup() {
        parent::startup();
        $this->menu->setActive(':Admin:Shop:Home:view');
    }

}
