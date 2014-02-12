<?php

namespace WebEdit\Shop\Category\Model;

use WebEdit\Shop\Category;
use WebEdit\Menu;
use WebEdit\Shop\Product;
use WebEdit\Model;

class Facade extends Model\Facade {

    public $repository;
    private $menuFacade;
    private $productFacade;

    public function __construct(Category\Model\Repository $repository, Menu\Model\Facade $menuFacade, Product\Model\Facade $productFacade) {
        $this->repository = $repository;
        $this->menuFacade = $menuFacade;
        $this->productFacade = $productFacade;
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
        if ($this->productFacade->repository->countProductsInMenu($category->menu)) {
            throw new Model\Exception('This category can\'t be removed because there\'s at least one product in this category.');
        }
        $this->menuFacade->deleteMenu($category->menu);
        return $this->repository->remove($category);
    }

}
