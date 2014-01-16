<?php

namespace WebEdit\Shop\Admin\Presenter;

use WebEdit\Shop\Admin\Presenter\Base;

final class Home extends Base {

    protected function startup() {
        parent::startup();
        $this->menu->setActive(':Shop:Admin:Home:view');
    }

}
