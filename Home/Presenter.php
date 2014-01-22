<?php

namespace WebEdit\Shop\Home;

use WebEdit\Shop;

final class Presenter extends Shop\Presenter {

    public function actionView() {
        $this->menu->setActive(':Shop:Home:Presenter:view');
    }

    public function renderView() {
        
    }

}
