<?php

namespace CMS\Shop\Component\Products;

use CMS\Component\BaseControl;

final class ProductsControl extends BaseControl {

    /**
     * @inject
     * @var \CMS\Shop\Model\CategoryRepository
     */
    public $categoryRepository;

    /**
     * @inject
     * @var \CMS\Shop\Model\ProductRepository
     */
    public $productRepository;

    /**
     * @inject
     * @var \CMS\Model\NodeRepository
     */
    public $nodeRepository;

    public function renderFeatured() {
        $categories = $this->categoryRepository->getCategoriesIds();
        $template = $this->template;
        $template->products = $this->productRepository->getProductsInCategories($categories);
        $template->setFile(__DIR__ . "/templates/list.latte");
        $template->render();
    }

    public function renderCategory($category) {
        $nodes = $this->nodeRepository->getIdsOfChildNodes($category->node);
        $nodes[] = $category->node->id;
        $categories = $this->categoryRepository->getCategoriesInNodes($nodes);
        $template = $this->template;
        $template->products = $this->productRepository->getProductsInCategories($categories);
        $template->setFile(__DIR__ . "/templates/list.latte");
        $template->render();
    }

}