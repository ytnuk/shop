<?php

namespace WebEdit\Shop\Admin\Presenter;

use WebEdit\Shop;

final class Home extends Shop\Admin\Presenter {

    protected function startup() {
        parent::startup();
        $this->menu->setActive(':Shop:Admin:Home:view');
    }

}
