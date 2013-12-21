<?php

namespace CMS\Shop\Model;

use CMS\Model\Facade;
use CMS\Shop\Model\CategoryRepository;
use CMS\Menu\Model\NodeFacade;
use CMS\Shop\Model\ProductFacade;
use CMS\Shop\Form\CategoryFormContainer;
use CMS\Model\Exception\ModelException;

class CategoryFacade extends Facade {

    public $repository;
    private $nodeFacade;
    private $productFacade;

    public function __construct(CategoryRepository $repository, NodeFacade $nodeFacade, ProductFacade $productFacade) {
        $this->repository = $repository;
        $this->nodeFacade = $nodeFacade;
        $this->productFacade = $productFacade;
    }

    public function getFormContainer($category = NULL) {
        return new CategoryFormContainer($category);
    }

    public function addCategory(array $data) {
        $data['node']['link'] = ':Shop:Category:view';
        $data['node']['link_admin'] = ':Admin:Shop:Category:edit';
        $node = $this->nodeFacade->addNode($data['node'], 'shop_category');
        $data['category']['node_id'] = $node->id;
        $category = $this->repository->insert($data['category']);
        $this->nodeFacade->editNode($node, array('link_id' => $category->id));
        return $category;
    }

    public function editCategory($category, array $data) {
        $this->nodeFacade->editNode($category->node, $data['node']);
        return $this->repository->update($category, $data['category']);
    }

    public function deleteCategory($category) {
        $nodes = $this->nodeFacade->repository->getIdsOfChildNodes($category->node);
        $nodes[] = $category->node_id;
        if ($this->productFacade->repository->getProductsInNodes($nodes)) {
            throw new ModelException('Category is not empty.');
        }
        $this->nodeFacade->deleteNode($category->node);
        return $this->repository->remove($category);
    }

}
