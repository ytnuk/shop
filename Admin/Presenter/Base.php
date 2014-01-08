<?php

namespace CMS\Shop\Admin\Presenter;

use CMS\Admin\Presenter;

abstract class Base extends Presenter\Base {

    protected function startup() {
        parent::startup();
        $this->menu->setActive(':Shop:Admin:Home:view');
        $this->menu->breadcrumbAdd(
                $this->translator->translate('shop.admin.overview'), "Home:view");
        $this->menu->breadcrumbAdd(
                $this->translator->translate('shop.admin.product.list'), "Product:list");
        $this->menu->breadcrumbAdd(
                $this->translator->translate('shop.admin.category.list'), "Category:list");
    }

}
