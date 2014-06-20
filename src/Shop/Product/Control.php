<?php

namespace WebEdit\Shop\Product;

use WebEdit;
use WebEdit\Shop\Product;
use WebEdit\Menu;
use WebEdit\Gallery;

final class Control extends WebEdit\Control {

    private $productRepository;
    private $menuRepository;
    private $category;
    private $galleryControlFactory;

    public function __construct(Product\Repository $productRepository, Menu\Repository $menuRepository, Gallery\Control\Factory $galleryControlFactory) {
        $this->productRepository = $productRepository;
        $this->menuRepository = $menuRepository;
        $this->galleryControlFactory = $galleryControlFactory;
    }

    public function renderList() {
        if ($this->category) {
            $menu = $this->menuRepository->getChildren($this->category->menu);
        } else {
            $menu = $this->menuRepository->getMenuByType('shop_category');
        }
        $template = $this->template;
        $template->products = $this->productRepository->getProductsInMenu($menu);
        $template->setFile($this->getTemplateFiles('list'));
        $template->render();
    }

    protected function createComponentGallery() {
        return new WebEdit\Control\Multiplier(function($id) {
            $product = $this->productRepository->getProduct($id);
            return $this->galleryControlFactory->create($product->gallery);
        });
    }

}
