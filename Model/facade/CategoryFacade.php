<?php

namespace CMS\Shop\Model;

use CMS\Model\BaseFacade;
use CMS\Shop\Model\CategoryRepository;
use CMS\Model\MenuFacade;

class CategoryFacade extends BaseFacade {

    private $categoryRepository;
    private $menuFacade;

    public function __construct(CategoryRepository $categoryRepository, MenuFacade $menuFacade) {
        $this->categoryRepository = $categoryRepository;
        $this->menuFacade = $menuFacade;
    }

    public function addCategory(array $data) {
        $data['node']['link'] = ':Shop:Category:view';
        $data['node']['link_admin'] = ':Admin:Shop:Category:edit';
        $node = $this->menuFacade->addNode($data['node']);
        $data['category']['node_id'] = $node->id;
        $category = $this->categoryRepository->insertCategory($data['category']);
        $this->menuFacade->editNode($node, array('link_id' => $category->id));
        return $category;
    }

    public function editCategory($category, array $data) {
        $this->menuFacade->editNode($category->node, $data['node']);
        return $this->categoryRepository->updateCategory($category, $data['category']);
    }

    public function deleteCategory($category) {
        if ($category->node->related('shop_product')->count() OR TRUE) {
            //TODO... productFacade count products in nodes (menuFacade getIdsOfChildNodes($category->node)  )
        } else {
            if ($this->menuFacade->deleteNode($category->node)) {
                return $this->categoryRepository->removeCategory($category);
            }
        }
    }

}
