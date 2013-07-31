<?php

namespace CMS\Shop;

final class HomePresenter extends BasePresenter {

    public function actionView() {
        $this->menu->setCurrent(':Shop:Home:view', 'link');
    }

    public function renderView() {
        
    }

}