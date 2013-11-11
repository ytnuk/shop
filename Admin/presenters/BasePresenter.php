<?php

namespace CMS\Admin\Shop;

use CMS\Admin\BasePresenter as Presenter;

abstract class BasePresenter extends Presenter {

    protected function startup() {
        parent::startup();
        $this->menu->setActive(':Admin:Shop:Home:view');
        $this->menu->breadcrumbAdd(
                $this->translator->translate('shop.admin.overview'), "Home:view");
        $this->menu->breadcrumbAdd(
                $this->translator->translate('shop.admin.products'), "Product:list");
        $this->menu->breadcrumbAdd(
                $this->translator->translate('shop.admin.categories'), "Category:list");
    }

}
