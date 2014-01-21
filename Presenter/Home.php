<?php

namespace WebEdit\Shop\Presenter;

use WebEdit\Shop;

final class Home extends Shop\Presenter {

    public function actionView() {
        $this->menu->setActive(':Shop:Home:view');
    }

    public function renderView() {
        
    }

}
