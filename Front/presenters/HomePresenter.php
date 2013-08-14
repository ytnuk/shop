<?php

namespace CMS\Shop;

final class HomePresenter extends BasePresenter {

    public function actionView() {
        $this->menu->setActive(':Shop:Home:view');
    }

    public function renderView() {
        
    }

}