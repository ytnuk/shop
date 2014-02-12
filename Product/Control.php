<?php

namespace WebEdit\Shop\Product;

use WebEdit;
use WebEdit\Shop\Category;
use WebEdit\Shop\Product;
use WebEdit\Menu;

final class Control extends WebEdit\Control {

    public $categoryFacade;
    public $productFacade;
    public $menuFacade;
    private $category;

    public function __construct($category, Category\Model\Facade $categoryFacade, Product\Model\Facade $productFacade, Menu\Model\Facade $menuFacade) {
        $this->category = $category;
        $this->categoryFacade = $categoryFacade;
        $this->productFacade = $productFacade;
        $this->menuFacade = $menuFacade;
    }

    public function renderFeatured() {
        $menus = $this->menuFacade->repository->getMenuFromTable('shop_category');
        $template = $this->template;
        $template->products = $this->productFacade->repository->getProductsInMenu($menus);
        $template->setFile(__DIR__ . "/Control/list.latte");
        $template->render();
    }

    public function renderCategory() {
        $menus = $this->menuFacade->repository->getChildren($this->category->menu);
        $template = $this->template;
        $template->products = $this->productFacade->repository->getProductsInMenu($menus);
        $template->setFile(__DIR__ . "/Control/list.latte");
        $template->render();
    }

}
