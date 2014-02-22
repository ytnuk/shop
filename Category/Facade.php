<?php

namespace WebEdit\Shop\Category;

use WebEdit;
use WebEdit\Shop\Category;
use WebEdit\Menu;
use WebEdit\Shop\Product;
use WebEdit\Model;

class Facade extends WebEdit\Facade {

    public $repository;
    private $menuFacade;
    private $productRepository;

    public function __construct(Category\Repository $repository, Menu\Facade $menuFacade, Product\Repository $productRepository) {
        $this->repository = $repository;
        $this->menuFacade = $menuFacade;
        $this->productRepository = $productRepository;
    }

    public function getFormContainer($category = NULL) {
        return new Category\Form\Container($category);
    }

    public function addCategory(array $data) {
        $data['menu']['link'] = ':Shop:Category:Presenter:view';
        $menu = $this->menuFacade->addMenu($data['menu']);
        $data['category']['menu_id'] = $menu->id;
        $category = $this->repository->insert($data['category']);
        $this->menuFacade->editMenu($menu, array('link_id' => $category->id));
        return $category;
    }

    public function editCategory($category, array $data) {
        $this->menuFacade->editMenu($category->menu, $data['menu']);
        return $this->repository->update($category, $data['category']);
    }

    public function deleteCategory($category) {
        if ($this->productRepository->countProductsInMenu($category->menu)) {
            throw new Model\Exception('This category can\'t be removed because there\'s at least one product in this category.');
        }
        $this->menuFacade->deleteMenu($category->menu);
        return $this->repository->remove($category);
    }

}
