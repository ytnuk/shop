<?php

namespace CMS\Shop\Presenter;

use CMS\Shop\Presenter\Base;

final class Home extends Base {

    public function actionView() {
        $this->menu->setActive(':Shop:Home:view');
    }

    public function renderView() {
        
    }

}
