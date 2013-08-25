<?php

namespace CMS\Shop\Component\Products;

use CMS\Component\BaseControl;
use CMS\Shop\Model\CategoryRepository;
use CMS\Shop\Model\ProductRepository;
use CMS\Model\NodeRepository;

final class ProductsControl extends BaseControl {

    /**
     * @var CategoryRepository
     */
    public $categoryRepository;

    /**
     * @var ProductRepository
     */
    public $productRepository;

    /**
     * @var NodeRepository
     */
    public $nodeRepository;

    public function __construct(CategoryRepository $categoryRepository, ProductRepository $productRepository, NodeRepository $nodeRepository) {
        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;
        $this->nodeRepository = $nodeRepository;
    }

    public function renderFeatured() {
        $categories = $this->categoryRepository->getCategoriesIds();
        $template = $this->template;
        $template->products = $this->productRepository->getProductsInCategories($categories);
        $template->setFile(__DIR__ . "/templates/list.latte");
        $template->render();
    }

    public function renderCategory($category) {
        $nodes = $this->nodeRepository->getIdsOfChildNodes($category->node);
        $nodes[] = $category->node_id;
        $categories = $this->categoryRepository->getIdsOfCategoriesInNodes($nodes);
        $template = $this->template;
        $template->products = $this->productRepository->getProductsInCategories($categories);
        $template->setFile(__DIR__ . "/templates/list.latte");
        $template->render();
    }

}