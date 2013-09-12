<?php

namespace CMS\Admin\Shop;

use CMS\Admin\BasePresenter as Presenter;

abstract class BasePresenter extends Presenter {

    protected function startup() {
        parent::startup();
        $this->menu->setActive(':Admin:Shop:Home:view');
    }

}
