<?php

namespace WebEdit\Shop\Home\Admin;

use WebEdit\Shop;

final class Presenter extends Shop\Admin\Presenter {

    protected function startup() {
        parent::startup();
        $this->menu->setActive(':Shop:Home:Admin:Presenter:view');
    }

}
