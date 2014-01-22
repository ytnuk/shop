<?php

namespace WebEdit\Shop\Category\Model;

use WebEdit\Shop\Category;
use WebEdit\Menu\Node;
use WebEdit\Shop\Product;
use WebEdit\Model;

class Facade extends Model\Facade {

    public $repository;
    private $nodeFacade;
    private $productFacade;

    public function __construct(Category\Model\Repository $repository, Node\Model\Facade $nodeFacade, Product\Model\Facade $productFacade) {
        $this->repository = $repository;
        $this->nodeFacade = $nodeFacade;
        $this->productFacade = $productFacade;
    }

    public function getFormContainer($category = NULL) {
        return new Category\Form\Container($category);
    }

    public function addCategory(array $data) {
        $data['node']['link'] = ':Shop:Category:Presenter:view';
        $data['node']['link_admin'] = ':Shop:Category:Admin:Presenter:edit';
        $node = $this->nodeFacade->addNode($data['node']);
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
            throw new Model\Exception('Category is not empty.');
        }
        $this->nodeFacade->deleteNode($category->node);
        return $this->repository->remove($category);
    }

}
