<?php

namespace WebEdit\Shop\Product;

use WebEdit;
use WebEdit\Shop\Category;
use WebEdit\Shop\Product;
use WebEdit\Menu\Node;

final class Control extends WebEdit\Control {

    public $categoryFacade;
    public $productFacade;
    public $nodeFacade;
    private $category;

    public function __construct($category, Category\Model\Facade $categoryFacade, Product\Model\Facade $productFacade, Node\Model\Facade $nodeFacade) {
        $this->category = $category;
        $this->categoryFacade = $categoryFacade;
        $this->productFacade = $productFacade;
        $this->nodeFacade = $nodeFacade;
    }

    public function renderFeatured() {
        $nodes = $this->nodeFacade->repository->getNodesInTable('shop_category');
        $template = $this->template;
        $template->products = $this->productFacade->repository->getProductsInNodes($nodes);
        $template->setFile(__DIR__ . "/Control/list.latte");
        $template->render();
    }

    public function renderCategory() {
        $nodes = $this->nodeFacade->repository->getIdsOfChildNodes($this->category->node, TRUE);
        $template = $this->template;
        $template->products = $this->productFacade->repository->getProductsInNodes($nodes);
        $template->setFile(__DIR__ . "/Control/list.latte");
        $template->render();
    }

}
