<?php

namespace CMS\Shop\Component\Products;

use CMS\Component\BaseControl;
use CMS\Shop\Model\CategoryFacade;
use CMS\Shop\Model\ProductFacade;
use CMS\Menu\Model\NodeFacade;

final class ProductsControl extends BaseControl {

    /**
     * @var CategoryFacade
     */
    public $categoryFacade;

    /**
     * @var ProductFacade
     */
    public $productFacade;

    /**
     * @var NodeFacade
     */
    public $nodeFacade;

    public function __construct(CategoryFacade $categoryFacade, ProductFacade $productFacade, NodeFacade $nodeFacade) {
        $this->categoryFacade = $categoryFacade;
        $this->productFacade = $productFacade;
        $this->nodeFacade = $nodeFacade;
    }

    public function renderFeatured() {
        $nodes = $this->categoryFacade->repository->getIdsOfParentNodes();
        $template = $this->template;
        $template->products = $this->productFacade->repository->getProductsInNodes($nodes);
        $template->setFile(__DIR__ . "/templates/list.latte");
        $template->render();
    }

    public function renderCategory($category) {
        $nodes = $this->nodeFacade->repository->getIdsOfChildNodes($category->node);
        $nodes[] = $category->node_id;
        $template = $this->template;
        $template->products = $this->productFacade->repository->getProductsInNodes($nodes);
        $template->setFile(__DIR__ . "/templates/list.latte");
        $template->render();
    }

}
