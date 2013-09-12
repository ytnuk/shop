<?php

namespace CMS\Shop\Model;

use CMS\Model\BaseFacade;
use CMS\Shop\Model\CategoryNotEmptyException;
use CMS\Shop\Model\CategoryRepository;
use CMS\Model\NodeFacade;

class CategoryFacade extends BaseFacade {

    public $repository;
    private $nodeFacade;

    public function __construct(CategoryRepository $repository, NodeFacade $nodeFacade) {
        $this->repository = $repository;
        $this->nodeFacade = $nodeFacade;
    }

    public function addCategory(array $data) {
        $data['node']['link'] = ':Shop:Category:view';
        $data['node']['link_admin'] = ':Admin:Shop:Category:edit';
        $node = $this->nodeFacade->addNode($data['node']);
        $data['category']['node_id'] = $node->id;
        $category = $this->repository->insertCategory($data['category']);
        $this->nodeFacade->editNode($node, array('link_id' => $category->id));
        return $category;
    }

    public function editCategory($category, array $data) {
        $this->nodeFacade->editNode($category->node, $data['node']);
        return $this->repository->updateCategory($category, $data['category']);
    }

    public function deleteCategory($category) {
        if (TRUE) {
            //TODO... productFacade count products in nodes (menuFacade getIdsOfChildNodes($category->node)  )
            throw new CategoryNotEmptyException('Category is not empty.');
        } else {
            if ($this->nodeFacade->deleteNode($category->node)) {
                return $this->repository->removeCategory($category);
            }
        }
    }

}
