<?php

namespace WebEdit\Shop\Product;

use WebEdit;
use WebEdit\Shop\Product;
use WebEdit\Menu;

final class Control extends WebEdit\Control {

    private $productRepository;
    private $menuRepository;
    private $category;

    public function __construct($category, Product\Repository $productRepository, Menu\Repository $menuRepository) {
        $this->category = $category;
        $this->productRepository = $productRepository;
        $this->menuRepository = $menuRepository;
    }

    public function renderFeatured() {
        $menus = $this->menuRepository->getMenuFromTable('shop_category');
        $template = $this->template;
        $template->products = $this->productRepository->getProductsInMenu($menus);
        $template->setFile(__DIR__ . "/Control/list.latte");
        $template->render();
    }

    public function renderCategory() {
        $menus = $this->menuRepository->getChildren($this->category->menu);
        $template = $this->template;
        $template->products = $this->productRepository->getProductsInMenu($menus);
        $template->setFile(__DIR__ . "/Control/list.latte");
        $template->render();
    }

}
