<?php

namespace WebEdit\Shop\Category;

use WebEdit;
use WebEdit\Shop\Category;
use WebEdit\Shop\Product;
use WebEdit\Menu\Node;

final class Control extends WebEdit\Control {

    public $categoryFacade;
    public $productFacade;
    public $nodeFacade;

    public function __construct(Category\Model\Facade $categoryFacade, Product\Model\Facade $productFacade, Node\Model\Facade $nodeFacade) {
        $this->categoryFacade = $categoryFacade;
        $this->productFacade = $productFacade;
        $this->nodeFacade = $nodeFacade;
    }

    public function renderFeatured() {
        $nodes = $this->categoryFacade->repository->getIdsOfParentNodes();
        $template = $this->template;
        $template->products = $this->productFacade->repository->getProductsInNodes($nodes);
        $template->setFile(__DIR__ . "/templates/Control/list.latte");
        $template->render();
    }

    public function renderProducts($category) {
        $nodes = $this->nodeFacade->repository->getIdsOfChildNodes($category->node);
        $nodes[] = $category->node_id;
        $template = $this->template;
        $template->products = $this->productFacade->repository->getProductsInNodes($nodes);
        $template->setFile(__DIR__ . "/templates/Control/list.latte");
        $template->render();
    }

}
