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

    public function renderList() {
        if ($this->category) {
            $menu = $this->menuRepository->getChildren($this->category->menu);
        } else {
            $menu = $this->menuRepository->getMenuFromTable('shop_category');
        }
        $template = $this->template;
        $template->products = $this->productRepository->getProductsInMenu($menu);
        $template->setFile($this->getTemplateFiles('list'));
        $template->render();
    }

}
