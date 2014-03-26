<?php

namespace WebEdit\Shop\Category;

use WebEdit\Shop\Category;
use WebEdit\Menu;
use WebEdit\Shop\Product;

final class Facade {

    public $repository;
    private $menuFacade;
    private $productRepository;

    public function __construct(Category\Repository $repository, Menu\Facade $menuFacade, Product\Repository $productRepository) {
        $this->repository = $repository;
        $this->menuFacade = $menuFacade;
        $this->productRepository = $productRepository;
    }

    public function addCategory(array $data) {
        $menu = $this->menuFacade->addMenu($data);
        $data['category']['menu_id'] = $menu->id;
        $category = $this->repository->insert($data['category']);
        $data['menu']['link'] = ':Shop:Category:Presenter:view';
        $data['menu']['link_id'] = $category->id;
        $this->menuFacade->editMenu($menu, $data);
        return $category;
    }

    public function editCategory($category, array $data) {
        $this->menuFacade->editMenu($category->menu, $data);
        $this->repository->update($category, $data['category']);
    }

    public function deleteCategory($category) {
        if ($this->productRepository->countProductsInMenu($category->menu)) {
            throw new Category\Exception('shop.category.not_empty');
        }
        $this->menuFacade->deleteMenu($category->menu);
        $this->repository->remove($category);
    }

}
